<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        // validation
        $credentials = $request->validate([
            'email' => ['required', 'string', 'max:255', 'email'],
            'password' => ['required', 'string', 'min:5'],
        ]);

        // login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('dashboard')->with('success', 'Welcome back!');
        }

        return back()
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->onlyInput('email');
    }
}
