<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
</head>
<body>
    <h1>Lista de Empleados</h1>

    <a href="{{ route('empleados.create') }}">Agregar Empleado</a>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Email</th>
                <th>Salario Base</th>
                <th>Cargo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->id }}</td>
                    <td>{{ $empleado->nombre }}</td>
                    <td>{{ $empleado->apellido }}</td>
                    <td>{{ $empleado->dni }}</td>
                    <td>{{ $empleado->email }}</td>
                    <td>{{ $empleado->salario_base }}</td>
                    <td>{{ $empleado->cargo }}</td>
                    <td>
                        <a href="{{ route('empleados.show', $empleado->id) }}">Ver</a>
                        <a href="{{ route('empleados.edit', $empleado->id) }}">Editar</a>
                        <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($empleados->isEmpty())
        <p>No hay empleados registrados en la base de datos.</p>
    @endif
</body>
</html>
