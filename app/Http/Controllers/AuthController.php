<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getLoginPage()
    {
        return view('auth.login');
    }

    public function getRegisterPage()
    {
        return view('auth.register');
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $isRemember = isset($validated['remember']) && $validated['remember'] == 'on';

        if (Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password']
        ], $isRemember)) {
            $request->session()->regenerate();
            return redirect()->intended();
        }

        return back()->withErrors([
            'error' => 'Error'
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

//        Mail::to($user)->send(new SuccessRegister($user));
//
//        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('main');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('main');
    }
}
