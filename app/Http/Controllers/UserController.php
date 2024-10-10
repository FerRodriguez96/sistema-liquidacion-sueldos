<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\JobTitle; // Importar el modelo JobTitle
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Muestra una lista de usuarios.
     */
    public function index()
    {
        // Obtener todos los usuarios junto con su JobTitle
        $users = User::with('jobTitle')->get();

        // Retornar la vista 'users' con la lista de usuarios
        return view('users', compact('users'));
    }

    /**
     * Muestra los detalles de un usuario específico.
     */
    public function show($id)
    {
        // Buscar al usuario por su ID junto con su JobTitle
        $user = User::with('jobTitle')->findOrFail($id);

        // Retornar la vista de detalles con los datos del usuario
        return view('users.show', compact('user'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        // Obtener todos los cargos (Job Titles) para mostrarlos en un select
        $jobTitles = JobTitle::all();

        return view('users.create', compact('jobTitles'));
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
            'job_title_id' => 'required|exists:job_titles,id', // Validar que el cargo exista
        ]);

        // Crear el nuevo usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encriptar la contraseña
            'job_title_id' => $request->job_title_id, // Guardar el ID del cargo
        ]);

        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     */
    public function edit($id)
    {
        // Buscar el usuario por su ID
        $user = User::findOrFail($id);
        $jobTitles = JobTitle::all(); // Obtener los cargos

        return view('users.edit', compact('user', 'jobTitles'));
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
            'job_title_id' => 'required|exists:job_titles,id', // Validar que el cargo exista
        ]);

        // Actualizar el usuario
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'job_title_id' => $request->job_title_id, // Actualizar el cargo
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
