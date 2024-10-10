<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\JobTitle; // Importar el modelo JobTitle
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista de registro.
     */
    public function create(): View
    {
        // Asegurarse de que los cargos existan o crearlos si no existen
        $jobTitles = [
            ['name' => 'Administrador', 'base_salary' => 5000],
            ['name' => 'Jefe', 'base_salary' => 4000],
            ['name' => 'Empleado', 'base_salary' => 3000],
        ];

        // Insertar los cargos si no existen
        foreach ($jobTitles as $jobTitle) {
            JobTitle::firstOrCreate(
                ['name' => $jobTitle['name']],
                ['base_salary' => $jobTitle['base_salary']]
            );
        }

        // Obtener todos los cargos de la tabla para mostrarlos en la vista
        $jobTitles = JobTitle::all();

        return view('auth.register', compact('jobTitles'));
    }

    /**
     * Maneja una solicitud de registro entrante.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validar los datos ingresados
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'string', 'max:20'],
            'job_title_id' => ['required', 'exists:job_titles,id'], // Validar que el ID del cargo exista
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Crear el nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'dni' => $request->dni,
            'job_title_id' => $request->job_title_id, // Relacionar el cargo por su ID
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Evento de registro
        event(new Registered($user));

        // Loguear al usuario recién registrado
        Auth::login($user);

        // Redirigir al home
        return redirect(RouteServiceProvider::HOME);
    }
}
