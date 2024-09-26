<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
</head>
<body>
    <h1>Editar Empleado</h1>

    <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="{{ $empleado->nombre }}" required><br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" value="{{ $empleado->apellido }}" required><br>

        <label for="dni">DNI:</label>
        <input type="text" name="dni" id="dni" value="{{ $empleado->dni }}" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ $empleado->email }}" required><br>

        <label for="salario_base">Salario Base:</label>
        <input type="number" name="salario_base" id="salario_base" value="{{ $empleado->salario_base }}" required step="0.01"><br>

        <label for="cargo">Cargo:</label>
        <input type="text" name="cargo" id="cargo" value="{{ $empleado->cargo }}" required><br>

        <button type="submit">Actualizar</button>
    </form>

    <a href="{{ route('empleados.index') }}">Volver a la lista</a>
</body>
</html>
