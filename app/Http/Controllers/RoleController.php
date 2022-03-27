<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return response()->json([
            'message'=>'Roles Received Successfully!!',
            'data'=>$roles
        ]);
    }

    public function all_roles()
    {
        $roles = Role::select('name as value','id as key')->get();
        return response()->json([
            'message'=>'Roles Received Successfully!!',
            'data'=>$roles
        ]);
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
        $request->validate([
            'name'=>'required|unique:roles,name',
            'permissions'=>'required|exists:permissions,name',
        ]);

        $data = $request->all();
        unset($data['permissions']);

        $role = Role::create($data);
        $role->syncPermissions($request->permissions);

        return response()->json([
            'message'=>'Role Created Successfully!!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findorfail($id);
        $permissions = $role->permissions()->pluck('name');
        return response()->json([
            'message'=>'Role Updated Successfully!!',
            'role'=>$role,
            'permissions'=>$permissions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|unique:roles,name,'.$id,
            'permissions'=>'required|exists:permissions,name',
        ]);

        $data = $request->all();
        unset($data['permissions']);
        $role = Role::find($id);
        $role->update($data);
        $role->syncPermissions($request->permissions);

        return response()->json([
            'message'=>'Role Updated Successfully!!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::findorfail($id)->delete();
        return response()->json([
            'message'=>'Role Deleted Successfully!!'
        ]);
    }
}
