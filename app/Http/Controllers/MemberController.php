<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Group;
use App\SupervisorGroup;

class MemberController extends Controller
{
    private $supervisorGroups; 

    public function __construct()
    {
        
        $this->middleware('role:Admin|Supervisor', ['only' => ['store', 'destroy', 'index', 'edit']]);
        $this->middleware('role:Admin|Supervisor|Member', ['only' => ['show', 'update']]);
        
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
            "title" => "Corp Members",
            "sub_title" => "Index"
        ];

        $members = User::with('profile')->role('Member')->get();

        
        //dd($supervisorGroups);

        if(auth()->user()->hasRole('Supervisor|Official')) {

            $this->supervisorGroups = SupervisorGroup::where('user_id', auth()->user()->id)->get();

            $members = $members->filter(function ($value, $key) {
                return $this->supervisorGroups->contains('group_id', $value->profile->group_id);
            });
        }
        

        return view('member.index', compact('links', 'members'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $member)
    {
        //
        $links = [
            "title" => "Corp Members",
            "sub_title" => "Show"
        ];

        //dd($member);
        if(!$member->hasRole('Member')){
            return back();
        }


        $groups = Group::all()->sortBy('name');

        return view('member.show', compact('member', 'links', 'groups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $member)
    {
        //
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $member)
    {
        //
        // $member->update([

        // ]);

        return back()->with('success', "Member's record updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $member)
    {
        //
        try {

            $member->delete();

        } catch(\Exception $e) {

            return back()->with('failure', "Error deleting member");
        }
        
        return back()->with('success', 'Member deleted successfully');
    }
}
