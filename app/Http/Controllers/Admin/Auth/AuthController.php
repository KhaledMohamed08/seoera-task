<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'data'     => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $this->prepareCredentials($validated['data'], $validated['password']);

        if (! Auth::attempt($credentials)) {
            return back()
                ->withInput($request->only('data'))
                ->withErrors(['fail' => 'Invalid email/phone or password.']);
        }

        if (Auth::user()->type !== 'admin') {
            Auth::logout();
            return redirect()->route('login')
                ->withErrors(['fail' => 'You do not have admin access.']);
        }

        $request->session()->regenerate();

        return redirect()->route('admin.index');
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login');
    }

    private function prepareCredentials(string $data, string $password): array
    {
        if (filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return ['email' => strtolower($data), 'password' => $password];
        }

        return ['phone' => $data, 'password' => $password];
    }
}
