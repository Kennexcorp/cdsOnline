<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SupervisorGroup;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {

        $values = collect([]);

        $group = collect([]);
        
        if(auth()->user()->hasRole('Member'))
        {
            $values = auth()->user()->attendance;

            $group = SupervisorGroup::where("group_id", auth()->user()->profile->group_id)->first();
        }

        
        return view('dashboard', compact('values', 'group'));
    }


    public function landingPage()
    {

        return view('welcome');
        
    }
}
