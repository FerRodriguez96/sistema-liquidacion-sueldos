<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        // Obtener todos los empleados desde la base de datos
        $empleados = Empleado::all();

        // Pasar los empleados a la vista
        return view('index.index', compact('empleados'));
    }
    
    public function create()
    {
        // Mostrar formulario para crear un empleado
        return view('empleados.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'dni' => 'required|integer',
            'email' => 'required|email',
            'salario_base' => 'required|numeric',
            'cargo' => 'required|string',
        ]);

        // Guardar un nuevo empleado en la base de datos
        Empleado::create($request->all());
        return redirect()->route('empleados.index');
    }

    public function show(Empleado $empleado)
    {
        // Mostrar detalles de un empleado
        return view('empleados.show', compact('empleado'));
    }

    public function edit(Empleado $empleado)
    {
        // Mostrar formulario para editar un empleado
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        // Actualizar los datos de un empleado
        $empleado->update($request->all());
        return redirect()->route('empleados.index');
    }

    public function destroy(Empleado $empleado)
    {
        // Eliminar un empleado
        $empleado->delete();
        return redirect()->route('empleados.index');
    }
}
