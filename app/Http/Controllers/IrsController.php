<?php

namespace App\Http\Controllers;

use App\Models\Irs;
use App\Models\User;
use App\Models\Jadwal;
use App\Http\Requests\StoreIrsRequest;
use App\Http\Requests\UpdateIrsRequest;

class IrsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
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
   * @param  \App\Http\Requests\StoreIrsRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreIrsRequest $request)
  {
    $users_id = $request->user_id;
    $jadwal_id = $request->jadwal_id;

    // Create the irs for every $user_id from $users_id with $jadwal_id IF there is users_id
    if ($users_id) {
      foreach ($users_id as $user_id) {
        Irs::create([
          'user_id' => $user_id,
          'jadwal_id' => $jadwal_id
        ]);
      }
    }

    return redirect('/dashboard/jadwal/' . $jadwal_id)->with('status', 'Mahasiswa berhasil ditambahkan!');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Irs  $irs
   * @return \Illuminate\Http\Response
   */
  public function show(Irs $irs)
  {
    // Get the url path
    $path = \url()->current();
    $url = explode('/', $path);
    // Get the id from url[5]
    $id = $url[5];

    // Get jadwal with id from url
    $jadwal = Jadwal::find($id);

    // Get user data that is not in irs
    $users = User::whereNotIn('id', function ($query) use ($id) {
      $query->select('user_id')->from('irs')->where('jadwal_id', $id);
    })->where('nim', '!=', 123)->where('id', '!=', $jadwal->asprak_1)
      ->where('id', '!=', $jadwal->asprak_2)
      ->get();

    return view('dashboard.jadwal.mhs', [
      'title' => 'Tambah Mahasiswa | SIAPIN',
      'users' => $users,
      'jadwal' => $jadwal
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Irs  $irs
   * @return \Illuminate\Http\Response
   */
  public function edit(Irs $irs)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateIrsRequest  $request
   * @param  \App\Models\Irs  $irs
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateIrsRequest $request, Irs $irs)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Irs  $irs
   * @return \Illuminate\Http\Response
   */
  public function destroy(Irs $irs)
  {
    // Get the jadwal_id and id from url
    $path = url()->current();
    $url = explode('/', $path);
    $jadwal_id = $url[5];
    $id = $url[7];

    // Delete the irs with id from url
    Irs::destroy($id);

    return redirect('/dashboard/jadwal/' . $jadwal_id)->with('status', 'Mahasiswa berhasil dihapus!');
  }
}
