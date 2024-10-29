<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proyecto; 
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
        $user->load('proyectos'); 
        $proyectos = Proyecto::all();
        return view('crud_user.edit', compact('user', 'proyectos'));
    }
    

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rol' => 'required|in:admin,user',
            'proyectos' => 'nullable|array', // Permitir que sea nulo
            'proyectos.*.id' => 'exists:proyectos,id', 
            'proyectos.*.rol' => 'in:0,1', // Validar que el rol sea 0 o 1
        ]);
    
        $user->update($request->only(['name', 'email', 'rol']));
    
        foreach ($request->input('proyectos', []) as $data) {
            $user->proyectos()->syncWithoutDetaching([
                $data['id'] => ['lider' => (int)$data['rol']] 
            ]);
        }
    
        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }
}

