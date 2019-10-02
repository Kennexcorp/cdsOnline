<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Group;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\SupervisorGroup;

class SupervisorController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('role:Admin', ['only' => ['show', 'update', 'edit','store', 'destroy', 'index']]);
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
            "title" => "Supervisors",
            "sub_title" => "Index"
        ];

        $groups = Group::all()->sortBy('name');

        $supervisors = User::role('Supervisor')->get();

        return view('supervisor.index', compact('links', 'supervisors', 'groups'));
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
        Validator::make($request->all(), [
            
            'username' => 'required',
            'email' => 'required|unique:users',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'state' => 'required|not_in:*',
            'lga' => 'required|not_in:*',
            'cds_group' => 'required|not_in:*',
            'phone_number' =>'required|numeric'

        ])->validate();

        DB::beginTransaction();

        try{

            $user =  User::create([
                'name' => $request->username,
                'email' => $request->email,
                'password' => Hash::make("default123"),
                'status_id' => 1 //Active
            ]);
    
            $user->profile()->updateOrCreate([

                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'state' => $request->state,
                'lga' => $request->lga,
            ]);

            $user->groups->create([
                'group_id' => $request->cds_group,
            ]);

            //dd($user);
            $user->assignRole('Supervisor');
        } 
        catch(\Exception $e) {

            DB::rollBack();
            return back()->with("failure", "Error Creating Supervisor");

        }

        DB::commit();

        return back()->with("success", "Invite Successfully Sent to Supervisor");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $supervisor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $supervisor)
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
    public function update(Request $request, User $supervisor)
    {
        DB::beginTransaction();

        try{

            $supervisor->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
    
            $supervisor->profile()->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'state' => $request->state,
                'lga' => $request->lga,
                'phone_number' => $request->phone_number,
            ]);

        } 
        catch(\Exception $e) {

            DB::rollBack();
            return back()->with("failure", "Error updating supervisor");

        }

        DB::commit();
        

        return back()->with('success', "Supervisor's records updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $supervisor)
    {
        //
        try {

            $supervisor->delete();

        } catch(\Exception $e) {

            return back()->with('failure', "Error deleting Supervisor");
        }
        

        return back()->with('success', 'Supervisor deleted successfully');
    }

    public function addGroup(Request $request)
    {
        //dd($request);
        try {

            SupervisorGroup::create([
                'user_id' => $request->supervisor,
                'group_id' => $request->cds_group,
                'time' => "",
                'day' => ""
                
            ]);

        } catch(\Exception $e) {

            return back()->with('failure', "Error assigning group to Supervisor");
        }

        
        return back()->with('success', 'Group assigned to supervisor successfully');
    }

    public function removeGroup(Request $request) 
    {
        try {

            $group = SupervisorGroup::where('group_id', $request->group)->first();

            $group->delete();

        } catch(\Exception $e) {

            return back()->with('failure', "Error unassigning group from Supervisor");
        }
       

        return back()->with('success', 'Group unassigned successfully');
    }
}

