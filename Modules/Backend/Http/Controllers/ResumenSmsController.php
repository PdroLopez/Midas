<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Modules\Backend\Entities\ResumenSms;
use Session;
use Datetime;

class ResumenSmsController extends Controller
{

    public function index()
    {
        $now = new Datetime;
        $now = $now->format('Y-m-d');
        $antes = date('Y-m-d',strtotime($now."- 1 month"));
        if (Session::has('date_desde') !== true) {
            Session::put('date_desde',$antes);
        }
        if (Session::has('date_hasta') !== true) {
            Session::put('date_hasta',$now);
        }
        $resumen_sms = ResumenSms::whereDate('created_at', '>=', Session::get('date_desde'))->whereDate('created_at', '<=', Session::get('date_hasta'))->get();
        return view('backend::private.resumen_sms.index', compact('resumen_sms','now'));
    }

    public function destroy($id)
    {
        $resumen_sms = ResumenSms::find($id);
        $resumen_sms->delete();
        return redirect::back();
    }

    public function buscar_date_sms(Request $request){

        Session::put('date_desde',$request->desde);
        Session::put('date_hasta',$request->hasta);
        return redirect::back();
    }
}
