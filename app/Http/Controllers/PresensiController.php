<?php

namespace App\Http\Controllers;

use App\Models\Qr;
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
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StorePresensiRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StorePresensiRequest $request)
  {
    // Get the url
    $url = $request->url();

    // Get the id of IRS from url
    $id = substr($url, strrpos($url, '/') + 1);

    // Get the p from url parameter
    $p = $request->p;

    // Create new presensi with irs_id $id and pertemuan $p
    Presensi::create([
      'irs_id' => $id,
      'pertemuan' => $p
    ]);

    // Redirect to the previous page
    return redirect()->back();
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
    // Get the p parameter from URL
    $p = request()->p;

    // Get id from url
    $irs_id = $presensi->id;

    // Get presensi with irs_id and pertemuan p
    $presensi = Presensi::where('irs_id', $irs_id)->where('pertemuan', $p)->first();

    // Delete the presensi
    $presensi->delete();

    // Redirect to the previous page
    return redirect()->back();
  }

  public function generateQr()
  {
    // Get jadwal_id from url
    $jadwal_id = request()->jadwal_id;

    // Get pertemuan from url
    $pertemuan = request()->pertemuan;

    // Get jadwal data
    $jadwal = Jadwal::find($jadwal_id);

    // Find first if there is already a qr code with the same jadwal_id and pertemuan
    $qr = Qr::where('jadwal_id', $jadwal_id)->where('pertemuan', $pertemuan)->count() > 0;

    // Insert jadwal_id, pertemuan, and random_string to db and return the id
    if (!$qr) {
      // Generate random string 5 characters for the qr code
      $random_string = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5 / strlen($x)))), 1, 5);

      // Insert the data to db
      $qr = Qr::create([
        'jadwal_id' => $jadwal_id,
        'pertemuan' => $pertemuan,
        'qr_code' => $random_string
      ]);
    } else {
      $qr = Qr::where('jadwal_id', $jadwal_id)->where('pertemuan', $pertemuan)->first();
      $random_string = $qr->qr_code;
    }

    // Return view
    return view('presensi.qr', [
      'title' => 'Presensi | SIAPIN',
      'page_title' => 'Generate QR Code',
      'qr' => $qr,
      'random_string' => $random_string,
      'jadwal' => $jadwal,
    ]);
  }

  public function deleteQr($qr_id)
  {
    // Delete the qr code after some time using delayedDelete method
    $qr = new Qr;
    $qr->delayedDelete($qr_id, 10);
  }
}
