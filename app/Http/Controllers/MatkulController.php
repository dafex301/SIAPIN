<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use App\Http\Requests\StoreMatkulRequest;
use App\Http\Requests\UpdateMatkulRequest;

class MatkulController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $matkul = Matkul::all();

    return view('dashboard.matkul.index', [
      'title' => 'Mata Kuliah | SIAPIN',
      'page_title' => 'Daftar Mata Kuliah',
      'page' => 'matkul',
      'matkul' => $matkul
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    // Create mata kuliah
    return view('dashboard.matkul.create', [
      'title' => 'Tambah Mata Kuliah | SIAPIN'
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreMatkulRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreMatkulRequest $request)
  {
    // Store mata kuliah
    $validatedData = $request->validate([
      'kode_matkul' => ['required', 'string', 'max:255', 'unique:matkuls'],
      'nama_matkul' => ['required', 'string', 'max:255'],
      'pertemuan' => ['required', 'integer', 'min:1', 'max:12'],
    ]);

    Matkul::create($validatedData);

    return redirect('/dashboard/matkul')
      ->with('success', 'Mata kuliah berhasil ditambahkan');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Matkul  $matkul
   * @return \Illuminate\Http\Response
   */
  public function show(Matkul $matkul)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Matkul  $matkul
   * @return \Illuminate\Http\Response
   */
  public function edit(Matkul $matkul)
  {
    // Edit mata kuliah
    return view('dashboard.matkul.edit', [
      'title' => 'Edit Mata Kuliah | SIAPIN',
      'matkul' => $matkul
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateMatkulRequest  $request
   * @param  \App\Models\Matkul  $matkul
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateMatkulRequest $request, Matkul $matkul)
  {
    // Update mata kuliah
    $validatedData = $request->validate([
      'kode_matkul' => ['required', 'string', 'max:255', 'unique:matkuls,kode_matkul,' . $matkul->id],
      'nama_matkul' => ['required', 'string', 'max:255'],
      'pertemuan' => ['required', 'integer', 'min:1', 'max:12'],
    ]);

    $matkul->update($validatedData);

    return redirect('/dashboard/matkul')
      ->with('success', 'Mata kuliah berhasil diubah');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Matkul  $matkul
   * @return \Illuminate\Http\Response
   */
  public function destroy(Matkul $matkul)
  {
    // Delete matkul
    $matkul->delete();

    // Redirect to /dashboard/matkul
    return redirect('/dashboard/matkul')->with('success', 'Mata kuliah berhasil dihapus');
  }
}
