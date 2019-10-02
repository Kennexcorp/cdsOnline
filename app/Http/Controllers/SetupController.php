<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetupController extends Controller
{
    //
    public function index()
    {
        $links = [
            "title" => "System Setup",
            "sub_title" => "Index"
        ];
        

        return view('setup.index', compact('links'));
    }

    public function regFeeSetup()
    {
        $links = [
            "title" => "System Setup",
            "sub_title" => "Registration Fee"
        ];
        

        return view('setup.fees', compact('links'));
    }


    public function registrationFee(Request $request)
    {

    }

    public function gatewayToggle(Request $request)
    {
        $links = [
            "title" => "System Setup",
            "sub_title" => "Gateway Toggle"
        ];
        

        return view('setup.gateway', compact('links'));
    }

    public function emailToogle(Request $request)
    {

    }
}
