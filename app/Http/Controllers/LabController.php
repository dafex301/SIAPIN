<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Http\Requests\StoreLabRequest;
use App\Http\Requests\UpdateLabRequest;

class LabController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $labs = Lab::all();
    return view('dashboard.lab.index', [
      'title' => 'Lab | SIAPIN',
      'page_title' => 'Daftar Lab',
      'page' => 'lab',
      'lab' => $labs
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('dashboard.lab.create', [
      'title' => 'Lab | SIAPIN',
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreLabRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreLabRequest $request)
  {
    $validatedData = $request->validate([
      'nama' => ['required', 'string', 'max:255', 'unique:labs'],
      'gedung' => ['required', 'string', 'max:255'],
      'lantai' => ['required', 'integer'],
      'kapasitas' => ['required', 'integer', 'min:1'],
    ]);

    Lab::create($validatedData);

    return redirect('/dashboard/lab')
      ->with('success', 'Lab berhasil ditambahkan');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Lab  $lab
   * @return \Illuminate\Http\Response
   */
  public function show(Lab $lab)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Lab  $lab
   * @return \Illuminate\Http\Response
   */
  public function edit(Lab $lab)
  {
    return view('dashboard.lab.edit', [
      'title' => 'Lab | SIAPIN',
      'lab' => $lab
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateLabRequest  $request
   * @param  \App\Models\Lab  $lab
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateLabRequest $request, Lab $lab)
  {
    $validatedData = $request->validate([
      'nama' => ['required', 'string', 'max:255', 'unique:labs,nama,' . $lab->id],
      'gedung' => ['required', 'string', 'max:255'],
      'lantai' => ['required', 'integer'],
      'kapasitas' => ['required', 'integer', 'min:1'],
    ]);

    Lab::where('id', $lab->id)
      ->update($validatedData);

    return redirect('/dashboard/lab')
      ->with('success', 'Lab berhasil diubah');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Lab  $lab
   * @return \Illuminate\Http\Response
   */
  public function destroy(Lab $lab)
  {
    Lab::destroy($lab->id);
    return redirect('/dashboard/lab')
      ->with('success', 'Lab berhasil dihapus');
  }
}
