<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use App\SupervisorGroup;

class GroupController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('role:Admin|Supervisor', ['only' => ['show', 'update', 'index']]);

        $this->middleware('role:Admin', ['only' => ['edit','store', 'destroy']]);

        $this->middleware('role:Supervisor', ['only' => ['updateSupervisorGroup']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $links = [
            "title" => "CDS Groups",
            "sub_title" => "Index"
        ];

        $groups = Group::all()->sortBy('name');

        return view('group.index', compact('links', 'groups'));
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
        try {

            Group::create($request->all());

        } catch(\Exception $e) {

            return back()->with('failure', "Error adding CDS group");
        }
        
        return back()->with('success', "CDS group added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
        
        
        try {

            $group->update($request->all());

        } catch(\Exception $e) {

            return back()->with('failure', "Error updating CDS group");
        }

        return back()->with('success', "CDS group updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
        if($group->profile->count() > 0)
        {
            return back()->with('failure', "Cannot delete group, Members are enrolled in it already");
        }

        try {

            $group->delete();

        } catch(\Exception $e) {

            return back()->with('failure', "Error deleting CDS group");
        }

        return back()->with('success', "CDS group deleted successfully");
    }

    public function updateSupervisorGroup(Request $request) {


        try {

            $group = SupervisorGroup::find($request->group);

            $group->update([

                'time' => $request->time,
                'day' => $request->day
            ]);

        } catch(\Exception $e) {

            return back()->with('failure', "failure updating CDS group info");
        }

        return back()->with('success', "CDS group info updated successfully");
    }
}
