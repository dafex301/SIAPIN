<?php

namespace App\Http\Controllers;

use App\Models\Qr;
use App\Models\Irs;
use App\Models\Presensi;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Requests\StorePresensiRequest;

class PresensiMhsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('dashboard.mhs.presensi.index', [
      'title' => 'Presensi | SIAPIN',
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreIrsRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StorePresensiRequest $request)
  {
    // Get the POST data
    $qr_code = $request->code;

    // Get user id
    $user_id = auth()->user()->id;

    // Get the qrs data from qr_code
    $qr = Qr::where('qr_code', $qr_code)->first();

    // Get jadwal_id and pertemuan from qr
    if ($qr) {
      $jadwal_id = $qr->jadwal_id;
      $pertemuan = $qr->pertemuan;

      // Get the irs data from user_id and jadwal_id
      $irs = Irs::where('user_id', $user_id)->where('jadwal_id', $jadwal_id)->first();

      // If irs data is found
      if ($irs) {
        // Check if there is already irs_id and pertemuan in presensis table
        $presensi = Presensi::where('irs_id', $irs->id)->where('pertemuan', $pertemuan)->first();

        // If there is no presensi data
        if (!$presensi) {
          // Create new presensi data
          Presensi::create([
            'irs_id' => $irs->id,
            'pertemuan' => $pertemuan
          ]);
          return redirect()->back()->with('success', 'Presensi berhasil');
        }

        // If there is presensi data
        return redirect()->back()->with('error', 'Sudah melakukan presensi!');

        // Redirect to dashboard.mhs.presensi.index with success message
        return redirect()->route('presensi.mhs.store')->with('success', 'Presensi berhasil!');
      }
    }
    // Redirect to /dashboard with error message
    return redirect()->route('presensi.mhs.store')->with('error', 'Presensi gagal!');
  }


  public function show(Presensi  $jadwal_id)
  {
    // Get jadwal from id 
    // $jadwal = Jadwal::find($id);
    dd($jadwal_id->nama);
    $presensi = Presensi::where('irs_id', $jadwal_id->nama)->get();
    return view('dashboard.mhs.presensi.history', [
      'title' => 'Presensi | SIAPIN',
      'presensi' => $presensi
    ]);
  }
}

