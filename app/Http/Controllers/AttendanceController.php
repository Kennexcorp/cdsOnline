<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\SupervisorGroup;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $links = [
            "title" => "Attendance",
            "sub_title" => "Index"
        ];

        $values = User::role('Member')->get();

        if(auth()->user()->hasRole('Official')) {

            //$this->supervisorGroups = SupervisorGroup::where('user_id', auth()->user()->id)->get();

            $values = $values->filter(function ($value, $key) {
                //return $this->supervisorGroups->contains('group_id', $value->profile->group_id);
                return auth()->user()->profile->group_id == $value->profile->group_id;
            });

        }
        
        if(auth()->user()->hasRole('Supervisor')) {

            $this->supervisorGroups = SupervisorGroup::where('user_id', auth()->user()->id)->get();

            $values = $values->filter(function ($value, $key) {
                return $this->supervisorGroups->contains('group_id', $value->profile->group_id);
            });
        }

        //dd($values);

        return view('attendance.index', compact('values', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $member = User::where('name', $request->state_code)->first();

        //$member = User::find($member->id);
        
        if($member == null)
        {
            return back()->with('failure', 'Member does not exist in database');
        }

        //dd($member->profile->state_code);

        if(auth()->user()->hasRole("Official"))
        {

            $group = auth()->user()->profile->group_id;
        }

        if(auth()->user()->hasRole("Supervisor"))
        {
            
            $groups = auth()->user()->groups->pluck('group_id');

            if($groups->contains($member->profile->group_id)) 
            {
                $attendance = $member->attendance->last();

                $attendance->update([
                    $request->week => Carbon::now()
                ]);
            }
            
            return back()->with('success', 'Attendance taken successfully...');

        }
        //dd($request);
        return back()->with('failure', 'Member does not belong to this CDS group...');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
