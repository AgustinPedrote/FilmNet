<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validar los datos del formulario del usuario
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:25', 'regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'],
            'password_confirmation' => ['required', 'same:password'],
            'nacimiento' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'sexo' => ['required', 'string'],
            'pais' => ['required', 'string'],
            'ciudad' => ['required', 'string', 'min:3', 'max:25', 'regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ]+$/'],
        ]);

        // Crea un nuevo usuario en la base de datos
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nacimiento' => $request->nacimiento,
            'sexo' => $request->sexo,
            'pais' => $request->pais,
            'ciudad' => $request->ciudad,
        ]);

        // Lanza el evento "Registered" para notificar el registro de usuario
        event(new Registered($user));

        // Inicia sesión automáticamente con el usuario recién registrado
        Auth::login($user);

        return redirect()->route('home.index')->with('success', 'Usuario registrado con éxito.');
    }
}
