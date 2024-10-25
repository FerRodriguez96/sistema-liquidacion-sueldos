<x-app-layout>
    <div class="py-12">
        <div class="w-1/2 mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-gray-800 shadow sm:rounded-lg">
                <h1 class="text-2xl font-bold mb-6 text-white">Realizar Liquidación para {{ $user->name }} {{ $user->last_name }}</h1>

                <!-- Mostrar los detalles del empleado -->
                <div class="bg-gray-700 shadow-md rounded p-4 mb-6">
                    <h2 class="text-xl font-semibold mb-4 text-white">Detalles del Empleado</h2>
                    <p class="text-gray-300"><strong>DNI:</strong> {{ $user->dni }}</p>
                    <p class="text-gray-300"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="text-gray-300"><strong>Puesto:</strong> {{ $user->jobTitle->name }}</p>
                    <p class="text-gray-300"><strong>Salario Base:</strong> ${{ number_format($user->jobTitle->base_salary, 2) }}</p>
                </div>

                <!-- Formulario para crear la liquidación -->
                <div class="bg-gray-700 shadow-md rounded p-6">
                    <h2 class="text-xl font-semibold mb-4 text-white">Confirmar Liquidación</h2>

                    <form action="{{ route('payouts.store') }}" method="POST">
                        @csrf
                        <!-- Campo oculto con el ID del usuario -->
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div class="mb-4">
                            <label for="payout_date" class="block text-sm font-medium text-gray-300">Fecha de Liquidación</label>
                            <input type="date" name="payout_date" id="payout_date"
                                   class="block w-full mt-1 p-2 border border-gray-600 bg-gray-800 text-white rounded-md" required>
                        </div>

                        <!-- Botón para confirmar la liquidación -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                Realizar Liquidación
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
