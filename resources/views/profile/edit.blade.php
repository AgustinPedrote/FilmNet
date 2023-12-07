<x-app-layout>

    <!-- Mensajes de éxito y error -->
    <div class="relative z-10">
        @if (session('success'))
            <div class="absolute top-[-10px] left-0 w-full mr-10 z-50">
                <x-success :status="session('success')" />
            </div>
        @endif

        @if (session('error'))
            <div class="absolute top-[-10px] left-0 w-full mr-10 z-50">
                <x-error :status="session('error')" />
            </div>
        @endif
    </div>

    <h1 class="text-2xl font-bold mb-8 mt-20 ml-10 border-b-2 border-blue-500 w-11/12 pb-2 text-gray-800">
        Perfil
    </h1>

    <div class="flex justify-center mb-8">
        <div class="bg-white p-6 max-w-4xl rounded-md shadow-lg w-full">
            <div class="max-w-xl p-4 sm:p-8">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="max-w-xl p-4 sm:p-8">
                @include('profile.partials.update-password-form')
            </div>

            <div class="max-w-xl p-4 sm:p-8">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
