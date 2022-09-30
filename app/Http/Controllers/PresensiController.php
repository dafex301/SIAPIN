<?php

namespace App\Http\Controllers;

use App\Models\Irs;
use App\Models\Jadwal;
use App\Models\Presensi;
use App\Http\Requests\StorePresensiRequest;
use App\Http\Requests\UpdatePresensiRequest;

class PresensiController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // Get all the jadwal
    $jadwal = Jadwal::all();
    return view('presensi.index', [
      'title' => 'Presensi | SIAPIN',
      'page_title' => 'Daftar Presensi',
      'page' => 'presensi',
      'jadwal' => $jadwal
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
   * @param  \App\Http\Requests\StorePresensiRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StorePresensiRequest $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Presensi  $presensi
   * @return \Illuminate\Http\Response
   */
  public function show(Presensi $presensi)
  {
    // Get the id from url
    $id = $presensi->id;

    // Get the jadwal from the id
    $jadwal = Jadwal::find($id);

    // Get the irs from $jadwal->id
    $irs = Irs::where('jadwal_id', $jadwal->id)->get();

    // Get p parameter from URL
    $p = request()->p;
    // If the parameter is empty, set p to 1
    if (!$p) {
      $p = 1;
    }

    return view('presensi.show', [
      'title' => 'Presensi | SIAPIN',
      'page_title' => 'Detail Presensi',
      'presensi' => $presensi,
      'irs' => $irs,
      'jadwal' => $jadwal
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Presensi  $presensi
   * @return \Illuminate\Http\Response
   */
  public function edit(Presensi $presensi)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdatePresensiRequest  $request
   * @param  \App\Models\Presensi  $presensi
   * @return \Illuminate\Http\Response
   */
  public function update(UpdatePresensiRequest $request, Presensi $presensi)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Presensi  $presensi
   * @return \Illuminate\Http\Response
   */
  public function destroy(Presensi $presensi)
  {
    //
  }
}
