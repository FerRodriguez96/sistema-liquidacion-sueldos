<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Muestra una lista de usuarios.
     */
    public function index()
    {
        // Obtener todos los usuarios desde la base de datos
        $users = User::all();

        // Retornar la vista 'users' con la lista de usuarios
        return view('users', compact('users'));
    }
    /**
     * Muestra los detalles de un usuario específico.
     */
    public function show($id)
    {
        // Buscar al usuario por su ID
        $user = User::findOrFail($id);

        // Retornar la vista de detalles con los datos del usuario
        return view('users.show', compact('user'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos ingresados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Crear el nuevo usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encriptar la contraseña
        ]);

        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->route('users')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     */
    public function edit($id)
    {
        // Buscar el usuario por su ID
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Actualiza la información de un usuario.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos ingresados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        // Actualizar el usuario
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Elimina un usuario.
     */
    public function destroy($id)
    {
        // Buscar el usuario por su ID y eliminarlo
        $user = User::findOrFail($id);
        $user->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
