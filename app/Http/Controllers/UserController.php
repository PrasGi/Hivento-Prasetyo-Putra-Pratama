<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
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
           'role_id' => 'required',
           'name' => 'required|string',
           'email' => 'required|unique:users|email',
            'password' => 'required'
        ]);

        if (User::create($validateData)) return response()->json(['message' => 'Success add data']);

        return response()->json(['message' => 'Failed add data']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->email != $user->email){
            $validateData = $request->validate([
                'role_id' => 'required',
                'name' => 'required|string',
                'email' => 'required|unique:users|email',
                'password' => 'required'
            ]);

            $user->role_id = $request->role_id;
            $user->name = $request->name;
            $user->email = $request->eamil;
            $user->password = $request->password;

            if ($user->save()) return response()->json(['message' => 'Success update data']);

            return response()->json(['message' => 'Eror sistem'], 401);
        } else {
            $validateData = $request->validate([
                'role_id' => 'required',
                'name' => 'required|string',
                'password' => 'required'
            ]);

            $user->role_id = $request->role_id;
            $user->name = $request->name;
            $user->password = $request->password;

            if ($user->save()) return response()->json(['message' => 'Success update data']);

            return response()->json(['message' => 'Eror sistem'], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (User::destroy('id', $user->id)) return response()->json(['message' => 'Success destroy data']);

        return response()->json(['message' => 'Failed destroy data']);
    }
}
