<?php

namespace Modules\Login\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Socialite;
use App\User;
use Str;
use Hash;
use App\Http\Controllers\SitesController;
use GuzzleHttp\Client;
use Session;
use Modules\Login\Entities\Region as region;
use Illuminate\Http\Request;
use Modules\Backend\Entities\Comunidad;
use App\DireccionUsuario;
use AWS;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/private';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('login::auth.login');
    }
    public function facebook($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function facebookRedirect($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            $id_soc = User::where('id_socialite',$user->getId())->first();
            if (!$id_soc) {
                $comunidades = Comunidad::all();
                $region = region::all();
                $dato = array(
                    'name'=>$user->name,
                    'email'=>$user->email,
                    'id_socialite'=>$user->id,
                    'nom_socialite'=>$provider
                );
                Session::put('datos_socialite',$dato);
                return view('login::auth.register-socialite',compact('region','comunidades'));
            }else{
                $user = $id_soc;
                Auth::login($user, true);
                return Redirect::action('SitesController@index');
            }

        } catch (Exception $e) {
            return Redirect::action('SitesController@index');
        }
    }
    public function registro_socialite(Request $request)
    {
        try {
            $user = User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> bcrypt($request->password),
                'roles_id'=> 19,
                'telefono'=> '+56'.$request->telefono,
                'id_socialite'=>Session::get('datos_socialite')['id_socialite'],
                'nom_socialite'=>Session::get('datos_socialite')['nom_socialite'],
                'bk_comunidades_id'=>$request->comunidades
            ]);
            DireccionUsuario::create([
                'nombre'=> $request->direccion,
                'users_id'=> $user->id,
                'bk_comunas_id'=> $request->bk_comunas_id,
                'bk_regiones_id'=> $request->bk_regiones_id
            ]);
            Session::forget('datos_socialite');
            Session::flash('mensaje',['content'=>'Registro realizado con exito','type'=>'primary']);
            Auth::login($user, true);
            return Redirect::action('SitesController@index');
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return view('login::auth.login');
        }
    }
    public function redirectToInstagramProvider()
    {
        $appId = config('services.instagram.client_id');
        $redirectUri = urlencode(config('services.instagram.redirect'));
        return redirect()->to("https://api.instagram.com/oauth/authorize?app_id={$appId}&redirect_uri={$redirectUri}&scope=user_profile,user_media&response_type=code");
    }

    public function instagramProviderCallback(Request $request)
    {        
        $code = $request->code;
        if (empty($code)) return redirect()->route('home')->with('error', 'Failed to login with Instagram.');

        $appId = config('services.instagram.client_id');
        $secret = config('services.instagram.client_secret');
        $redirectUri = config('services.instagram.redirect');

        $client = new Client();

        // obtener el acceso del token
        $response = $client->request('POST', 'https://api.instagram.com/oauth/access_token', [
            'form_params' => [
                'app_id' => $appId,
                'app_secret' => $secret,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $redirectUri,
                'code' => $code,
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            return redirect()->route('home')->with('error', 'Unauthorized login to Instagram.');
        }

        $content = $response->getBody()->getContents();
        $content = json_decode($content);

        $accessToken = $content->access_token;
        $userId = $content->user_id;
        // obtener la informacion del cliente
        $response = $client->request('GET', "https://graph.instagram.com/me?fields=id,username,account_type&access_token={$accessToken}");

        $content = $response->getBody()->getContents();
        $oAuth = json_decode($content);
        //$username = $oAuth->username;
        $id_soc = User::where('id_socialite',$oAuth->id)->first();
        if (!$id_soc) {
            $comunidades = Comunidad::all();
            $region = region::all();
            $dato = array(
                'name'=>$oAuth->username,
                'id_socialite'=>$oAuth->id,
                'nom_socialite'=>'instagram'
            );
            Session::put('datos_instagram',$dato);
            return view('login::auth.register-instagram',compact('region','comunidades'));
        }else{
            $user = $id_soc;
            Auth::login($user, true);
            return Redirect::action('SitesController@index');
        }
    }
    public function registro_instagram(Request $request)
    {
        try {
            $user = User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> bcrypt($request->password),
                'roles_id'=> 17,
                'telefono'=> '+56'.$request->telefono,
                'id_socialite'=>Session::get('datos_instagram')['id_socialite'],
                'nom_socialite'=>Session::get('datos_instagram')['nom_socialite'],
                'bk_comunidades_id'=>$request->comunidades,
                'nom_user_ig'=>Session::get('datos_instagram')['name']
            ]);
            DireccionUsuario::create([
                'nombre'=> $request->direccion,
                'users_id'=> $user->id,
                'bk_comunas_id'=> $request->bk_comunas_id,
                'bk_regiones_id'=> $request->bk_regiones_id
            ]);
            Session::forget('datos_instagram');
            Session::flash('mensaje',['content'=>'Registro realizado con exito','type'=>'primary']);
            Auth::login($user, true);
            return Redirect::action('SitesController@index');
        } catch (Exception $e) {
            Session::forget('datos_instagram');
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return view('login::auth.login');
        }
    }
    //vista telefono
    public function login_telefono()
    {
        return view('login::auth.login-phone');
    }
    //AWS envio telefono
    public function codigo_verificacion(Request $request)
    {
        $envio = '+56'.$request->telefono;
        $telefono = User::where('telefono',$envio)->first();
        if ($telefono) {
            $num = random_int(10000,999999);
            $telefono->cod_telefono = $num;
            $envio = '+56'.$telefono->telefono;
            $sms = AWS::createClient('sns');
    
            $sms->publish([
                'Message' => 'HOLA TU CODIGO ES  '.$num.',midas.la',
                'PhoneNumber' => $envio,    
                'MessageAttributes' => [
                    'AWS.SNS.SMS.SMSType'  => [
                        'DataType'    => 'String',
                        'StringValue' => 'Transactional',
                    ]
                ],
            ]);
            $phone = $telefono->telefono;
            return view('login::auth.codigo-verificar',compact('phone','num'));
        }else{
            do {
                $num = random_int(10000,999999);
                $user = User::where('cod_telefono',$num)->first();
            } while ($user);

            
            $sms = AWS::createClient('sns');
    
            $sms->publish([
                'Message' => 'HOLA TU CODIGO DE ACTIVACION ES  '.$num.',midas.la',
                'PhoneNumber' => $envio,    
                'MessageAttributes' => [
                    'AWS.SNS.SMS.SMSType'  => [
                        'DataType'    => 'String',
                        'StringValue' => 'Transactional',
                    ]
                ],
            ]);
            return view('login::auth.codigo-verificar',compact('phone','num'));
        }
        
    }
    public function telefono_codigo(Request $request)
    {
        $codigo_ingresado = $request->codigo;
        $codigo = $request->numero;
        if($codigo_ingresado == $codigo){
            $comunidades = Comunidad::all();
            $region = region::all();
            $dato = array(
                'telefono'=>$request->telefono,
                'codigo'=>$request->numero,
            );
            Session::put('telefono-register',$dato);
            return view('login::auth.register-phone',compact('region','comunidades'));
        }else{
            Session::flash('mensaje',['content'=>'El código ingresado no es el enviado, intentelo nuevamente','type'=>'danger']);
            return redirect::back();
        }
    }
    public function phone_register(Request $request)
    {
        try {
            $user = User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> bcrypt($request->password),
                'roles_id'=> 17,
                'telefono'=> '+56'.Session::get('telefono-register')['telefono'],
                'bk_comunidades_id'=>$request->comunidades,
                'cod_telefono'=>Session::get('telefono-register')['codigo']
            ]);
            DireccionUsuario::create([
                'nombre'=> $request->direccion,
                'users_id'=> $user->id,
                'bk_comunas_id'=> $request->bk_comunas_id,
                'bk_regiones_id'=> $request->bk_regiones_id
            ]);
            Session::forget('telefono-register');
            Session::flash('mensaje',['content'=>'Registro realizado con exito','type'=>'primary']);
            Auth::login($user, true);
            return Redirect::action('SitesController@index');
        } catch (Exception $e) {
            Session::forget('telefono-register');
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return view('login::auth.login');
        }
    }
}
