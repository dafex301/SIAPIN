<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function index()
  {
    // If the user is already logged in, go to dashboard
    if (Auth::check()) {
      return redirect()->route('dashboard');
    }
    return view('login.index', [
      'title' => 'Masuk | SIAPIN'
    ]);
  }

  // Authenticate user
  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'identifier' => ['required', 'string'],
      'password' => ['required', 'string'],
    ]);

    // Check if the credentials is email or nim
    if (filter_var($credentials['identifier'], FILTER_VALIDATE_EMAIL)) {
      $credentials['email'] = $credentials['identifier'];
      unset($credentials['identifier']);
    } else {
      $credentials['nim'] = $credentials['identifier'];
      unset($credentials['identifier']);
    }

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      return redirect()->intended('dashboard');
    }

    return back()->withErrors([
      'identifier' => 'The provided credentials do not match our records.',
    ])->onlyInput('identifier');
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
