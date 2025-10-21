<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('login');
        }

        return back()->withErrors([
            'error' => 'Пользователь с такими данными не найден. Проверьте правильность введённых email и пароля.',
        ])->onlyInput('email');
    }

    public function login(): View
    {
        return view('login', ['user' => Auth::user()]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $session = $request->session();
        $session->invalidate();

        $session->regenerateToken();

        return redirect('login');
    }
}
