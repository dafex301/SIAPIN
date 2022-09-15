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
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreMatkulRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreMatkulRequest $request)
  {
    //
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
    //
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
    //
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
