<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
    // Check if user is logged in
    if (auth()->check()) {
      // Redirect to dashboard
      return redirect()->intended('dashboard');
    }

    // If user isn't logged in
    return view('login.index', [
      'title' => 'Masuk | SIAPIN'
    ]);
  }
}
