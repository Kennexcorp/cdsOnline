<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function __construct()

    {

        $this->middleware('role:Admin', ['only' => ['index', 'update', 'edit','update', 'destroy', 'store']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::paginate(10);
        $permissions = Permission::all();
        $roles = Role::orderBy('id', 'DESC')->paginate(10);

        return view('roles.index', compact('users', 'permissions', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //
        Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ])->validate();

        //dd($request->permission);

        $role = Role::create([
            'name' => $request->name
        ]);
        $role->syncPermissions($request->permission);

        activity()->by(auth()->user()->id)->log("Created ". $role->name." to roles ");

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        return view('roles.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        //
        Validator::make($request->all(), [
            'name' => 'required',
            'permission' => 'required'
        ])->validate();

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->syncPermissions($request->permission);

        activity()->by(auth()->user()->id)->log("Updated ". $role->name." role ");

        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        //
        $role = Role::findOrFail($id);
        $role->delete();

        activity()->by(auth()->user()->id)->log("Deleted ". $role->name." role ");

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
    }
}
