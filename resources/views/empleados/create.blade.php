<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Empleado</title>
</head>
<body>
    <h1>Agregar Empleado</h1>

    <form action="{{ route('empleados.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required><br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" required><br>

        <label for="dni">DNI:</label>
        <input type="text" name="dni" id="dni" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="salario_base">Salario Base:</label>
        <input type="number" name="salario_base" id="salario_base" required step="0.01"><br>

        <label for="cargo">Cargo:</label>
        <input type="text" name="cargo" id="cargo" required><br>

        <button type="submit">Guardar</button>
    </form>

    <a href="{{ route('empleados.index') }}">Volver a la lista</a>
</body>
</html>
