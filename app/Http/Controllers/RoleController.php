<?php

namespace App\Http\Controllers;

use App\Models\Role;
use http\Env\Response;
use Illuminate\Http\Request;
use function PHPUnit\Framework\assertNotSame;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Role::all();
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
        $validateData = $request->validate([
           'name_role' => 'string|unique:roles'
        ]);

        if (Role::create($validateData)) return response()->json(['message' => 'Succes add data']);

        return response()->json(['message' => 'Failed add data']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return $role;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if ($request->name_role != $role->name_role){
            $validateData = $request->validate([
                'name_role' => 'string|unique:roles'
            ]);

            $role->name_role = $request->name_role;
            if ($role->save())return response()->json(['message' => 'Succes update data']);
        }

        return response()->json(['message' => 'data same before']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if (Role::destroy('id', $role->id)) return \response()->json(['message' => 'Succes destroy data']);

        return \response()->json(['message' => 'Failed destroy data']);
    }
}
