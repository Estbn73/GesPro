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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'rol' => 'required|in:admin,user',
            'proyectos' => 'nullable|array',
            'proyectos.*.id' => 'nullable|exists:proyectos,id',
            'proyectos.*.rol' => 'nullable|in:0,1',
        ]);
    
        // Actualizar datos del usuario
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'rol' => $validatedData['rol'],
        ]);
    
        // Sincronizar proyectos
        $proyectosData = [];
        if (!empty($validatedData['proyectos'])) {
            foreach ($validatedData['proyectos'] as $proyecto) {
                if (!empty($proyecto['id'])) {
                    $proyectosData[$proyecto['id']] = ['lider' => $proyecto['rol'] ?? 0];
                }
            }
        }
        $user->proyectos()->sync($proyectosData);
    
        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }
    
    
}

