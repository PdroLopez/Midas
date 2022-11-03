<?php

namespace Modules\Workflow\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class ChoferController extends Controller
{
    public function index()
    {
        return view('workflow::private.chofer');
    }   
	
}
