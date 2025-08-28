<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::with('role')->get();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=Role::all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id'
        ]);

        
        User::create([
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role_id'=>$request->role_id
        ]);

        return redirect()->route('users.index')->with('success','Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::findOrFail($id);
        $roles=Role::all();

        return view('users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role_id' => 'required|exists:roles,id'
        ]);

        $user=User::findOrFail($id);
        $user->email=$request->email;

        if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }
        $user->role_id=$request->role_id;

        $user->save();
        return redirect()->route('users.index')->with('success','Usuario actualizado correctamente');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success','Usuario eliminado correctamente');
    }
}
