<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Validar los datos del formulario del perfil de usuario
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:25', 'regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/'],
            'email' => ['required', 'string', 'email', 'max:100', Rule::unique('users')->ignore($user->id)], // Verificar si el valor del campo es único en la tabla de la base de datos
            'password' => ['nullable', 'string', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'],
            'password_confirmation' => ['nullable', 'same:password'],
            'nacimiento' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'sexo' => ['required', 'string'],
            'pais' => ['required', 'string'],
            'ciudad' => ['required', 'string', 'min:3', 'max:25', 'regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/'],
        ]);

        // Actualizar los datos del usuario
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password') ? Hash::make($request->input('password')) : $user->password,
            'nacimiento' => $request->input('nacimiento'),
            'sexo' => $request->input('sexo'),
            'pais' => $request->input('pais'),
            'ciudad' => $request->input('ciudad'),
        ]);

        if ($user->wasChanged('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Perfíl actualizado');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
