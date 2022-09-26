<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $users = User::all();
    return view('dashboard.mahasiswa.index', [
      'title' => 'Mahasiswa | SIAPIN',
      'page_title' => 'Daftar Mahasiswa',
      'page' => 'mahasiswa',
      'users' => $users
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('dashboard.mahasiswa.create', [
      'title' => 'Tambah Mahasiswa | SIAPIN',
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // Validate input
    $validatedData = $request->validate([
      'nama' => 'required|string',
      'nim' => 'required|string|unique:users',
      // Email could be null
      'email' => 'nullable|email|unique:users',
    ]);

    // Set the generated password
    $validatedData['password'] = bcrypt($validatedData['nim']);

    // Create user
    User::create($validatedData);

    return redirect('/dashboard/mahasiswa')->with('status', 'Mahasiswa berhasil ditambahkan!');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function show(User $mahasiswa)
  {
    // Get the id from url
    $user = User::find($mahasiswa->id);

    // Show all data from user
    return view('dashboard.mahasiswa.show', [
      'title' => 'Detail Mahasiswa | SIAPIN',
      'user' => $user
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $mahasiswa)
  {
    return view('dashboard.mahasiswa.edit', [
      'title' => 'Edit Mahasiswa | SIAPIN',
      'mahasiswa' => $mahasiswa,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $mahasiswa)
  {
    // Validate input
    $validatedData = $request->validate([
      'nama' => 'required|string',
      'nim' => 'required|string|unique:users,nim,' . $mahasiswa->id,
      // Email could be null
      'email' => 'nullable|email|unique:users,email,' . $mahasiswa->id,
    ]);

    // Update user
    $mahasiswa->update($validatedData);

    return redirect('/dashboard/mahasiswa')->with('status', 'Mahasiswa berhasil diubah!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $mahasiswa)
  {
    $mahasiswa->delete();

    return redirect('/dashboard/mahasiswa')->with('status', 'Mahasiswa berhasil dihapus!');
  }
}
