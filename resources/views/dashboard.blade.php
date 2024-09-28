<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="min-h-screen flex flex-col justify-center items-center py-12">
        <div class="max-w-4xl w-full bg-white dark:bg-gray-800 p-8 shadow-lg sm:rounded-lg">
            <h1 class="text-3xl font-semibold mb-6 text-center">Agregar Empleado</h1>

            <form action="" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="nombre" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <div>
                        <label for="apellido" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Apellido:</label>
                        <input type="text" name="apellido" id="apellido" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <div>
                        <label for="dni" class="block font-medium text-sm text-gray-700 dark:text-gray-300">DNI:</label>
                        <input type="text" name="dni" id="dni" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <div>
                        <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email:</label>
                        <input type="email" name="email" id="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <div>
                        <label for="salario_base" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Salario Base:</label>
                        <input type="number" name="salario_base" id="salario_base" required step="0.01" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <div>
                        <label for="cargo" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Cargo:</label>
                        <input type="text" name="cargo" id="cargo" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100">
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <a href="" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">Volver a la lista</a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
