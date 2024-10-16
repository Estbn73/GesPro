<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CrudUsersController extends Controller
{
    public function index()
{
    $users = User::all(); 
    return view('crud_user.index', compact('users')); 
}
    public function create()
    {
        return view('crud_user.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'rol' => 'required|string', 
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol' => $request->rol,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function show(User $user)
    {
        return view('crud_user.show', compact('user')); 
    }

    public function edit(User $user)
    {
        return view('crud_user.edit', compact('user')); 
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'rol' => 'required|string',
        ]);

        $user->update($request->only(['name', 'email', 'rol']));

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $user)
    {
        $user->delete(); 

        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}



