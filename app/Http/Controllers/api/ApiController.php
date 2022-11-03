<?php
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\RegisterAuthRequest;
use App\EstudianteSeccion;
use Log;
use GuzzleHttp\Client;
use Session;
use Auth;
use DB;
use Response;


class ApiController extends Controller
{

  public function prueba(){
    $client = new Client();

    $request = $client->request('GET', 'prueba', [
    'debug' => FALSE,
    'base_uri' => 'https://integracion.wooy.cl/api/',
    'verify' => false,
    ]);

    $response = $request->getBody();
    Log::info($response);

    return $response;
  }

  public function prueba2(){
    $client = new Client();

    $request = $client->request('GET', 'prueba', [
    'debug' => FALSE,
    'base_uri' => env('ENDPOINT_WOOY'),
    ]);

    $response = $request->getBody();
    Log::info($response);

    return $response;

  }





    public function webhook_facebook(Request $request){
        dd("llego");
    }

    public function webhook(Request $request){
        try {
            Log::info('webhook');
            Log::info($request->all());
            Log::info('dlksajkldjsakljdas');
            $array = $request->all();
            Session()->put('codigo',$array['code']);
            ApiController::teamtoken();
            ApiController::team();
            return "fin";
        } catch (\Throwable $th) {
            return "error";
        }

	}
    //apis para la conexion con microsoft
    public function teamautorize(){ // PRIMER METODO A OCUPAR Y ES PARA OPTENER EL CODE DE USUARIO Y LUEGO EL TOKEN DE USUARIO api/v1/webhook

		$URL_aUTORIZATION = "https://login.microsoftonline.com/9a5fd43e-7f7a-4d72-8881-c449098d628c/oauth2/v2.0/authorize?client_id=637f03bb-a47e-4299-a2be-41f2ded3bcd4&response_type=code&redirect_uri=".env('APP_URL')."api/v1/webhook&response_mode=query&scope=offline_access%20user.read%20mail.read%20Group.ReadWrite.All%20OnlineMeetings.ReadWrite&state=12345";

		return Redirect::to($URL_aUTORIZATION);
    }
    public function teamtoken(){ // paso numero dos en donde pido el token de usuario para que pueda crear un evento y obtener variables propias del usuario
        $client = new Client();

		$request = $client->request('POST', 'https://login.microsoftonline.com/9a5fd43e-7f7a-4d72-8881-c449098d628c/oauth2/v2.0/token', [
		'debug' => FALSE,
		'form_params' => [
				'client_id'=>'637f03bb-a47e-4299-a2be-41f2ded3bcd4',
				'scope'=>'https://graph.microsoft.com/OnlineMeetings.ReadWrite',
				'code'=>Session()->get('codigo'),
				'redirect_uri	'=>env('APP_URL').'api/webhook',
				'client_secret'=>'ee8KZs79c8X_~U8Gyl.9PHgx6qx-U60168',
				'grant_type'=>'authorization_code'

		],
		'headers' => [
			// 'Authorization' => 'Bearer '. env('TOKEN_FEEDBACK') .'',
			'Accept'        => 'application/x-www-form-urlencoded'

		]
		]);
		Log::info("teamtoken");
        Log::info($request->getBody());
        $json = json_decode($request->getBody(), true);
        Session()->put('access_token',$json['access_token']);
		return $json;
    }
    public function team(){ // posibl e paso tres en donde consulto por el id del usuario autenticado
        // ojo que no es el usuario que oepra lms sino el usuario que deberá crear lla reunion por team
        // puede ser no el mismo
		$client = new Client();

		$request = $client->request('GET', 'https://graph.microsoft.com/v1.0/me/', [
		'debug' => FALSE,
		'headers' => [ //token del usuario
			 'Authorization' => 'Bearer '.Session()->get('access_token'),
			 'Content-Type'=> 'application/json'
			// 'Accept'        => 'application/x-www-form-urlencoded'

		]
        ]);
        Log::info("teamtoken paso 3");
        Log::info($request->getBody());
        $team_json = json_decode($request->getBody(), true);
        Session()->put('id',$team_json['id']);

		return $team_json;
    }
}
