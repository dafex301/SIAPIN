<?php

namespace App\Http\Controllers;

use App\Models\Irs;
use App\Models\Jadwal;
use App\Http\Requests\StoreJadwalRequest;
use App\Http\Requests\UpdateJadwalRequest;

class JadwalController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $jadwal = Jadwal::all();

    return view('dashboard.jadwal.index', [
      'title' => 'Jadwal | SIAPIN',
      'jadwal' => $jadwal,
      'page_title' => 'Daftar Jadwal',
      'page' => 'jadwal'
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $matkuls = \App\Models\Matkul::all();
    $labs = \App\Models\Lab::all();
    $users = \App\Models\User::all();

    return view('dashboard.jadwal.create', [
      'title' => 'Tambah Jadwal | SIAPIN',
      'matkuls' => $matkuls,
      'labs' => $labs,
      'users' => $users
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreJadwalRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreJadwalRequest $request)
  {
    // Validate input
    $validatedData = $request->validate([
      'nama' => 'required|string',
      'hari' => 'required|string',
      'jam_mulai' => 'required|string',
      'jam_selesai' => 'required|string',
      'matkul_id' => 'required|integer',
      'lab_id' => 'required|integer',
      'asprak_1' => 'required|integer',
      'asprak_2' => 'string|nullable',
    ]);

    // Create jadwal
    Jadwal::create($validatedData);

    return redirect('/dashboard/jadwal')->with('status', 'Jadwal berhasil ditambahkan!');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Jadwal  $jadwal
   * @return \Illuminate\Http\Response
   */
  public function show(Jadwal $jadwal)
  {
    // Get the irs where the jadwal_id is the same as the jadwal id
    $irs = Irs::where('jadwal_id', $jadwal->id)->get();

    return view('dashboard.jadwal.show', [
      'title' => 'Detail Jadwal | SIAPIN',
      'jadwal' => $jadwal,
      'irs' => $irs
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Jadwal  $jadwal
   * @return \Illuminate\Http\Response
   */
  public function edit(Jadwal $jadwal)
  {
    $matkuls = \App\Models\Matkul::all();
    $labs = \App\Models\Lab::all();
    $users = \App\Models\User::all();

    return view('dashboard.jadwal.edit', [
      'title' => 'Edit Jadwal | SIAPIN',
      'jadwal' => $jadwal,
      'matkuls' => $matkuls,
      'labs' => $labs,
      'users' => $users
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateJadwalRequest  $request
   * @param  \App\Models\Jadwal  $jadwal
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateJadwalRequest $request, Jadwal $jadwal)
  {
    // Validate input
    $validatedData = $request->validate([
      'nama' => 'required|string',
      'hari' => 'required|string',
      'jam_mulai' => 'required|string',
      'jam_selesai' => 'required|string',
      'matkul_id' => 'required|integer',
      'lab_id' => 'required|integer',
      'asprak_1' => 'required|integer',
      'asprak_2' => 'string|nullable',
    ]);

    // Update jadwal
    $jadwal->update($validatedData);

    return redirect('/dashboard/jadwal')->with('status', 'Jadwal berhasil diubah!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Jadwal  $jadwal
   * @return \Illuminate\Http\Response
   */
  public function destroy(Jadwal $jadwal)
  {
    // Delete jadwal
    $jadwal->delete();

    return redirect('/dashboard/jadwal')->with('status', 'Jadwal berhasil dihapus!');
  }
}
