<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
// use App\Http\Requests\StoreMatkulRequest;
// use App\Http\Requests\UpdateMatkulRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatkulController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $matkuls = Matkul::where('kode_matkul', '!=', null)->latest()->paginate(30);
    return view('dashboard.matkul.index', compact('matkuls'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $matkuls = Matkul::where('kode_matkul', '!=', null)->latest()->paginate(30);
    return response()->json([
      'matkuls' => $matkuls
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreMatkulRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'kode_matkul' => 'required|unique:matkuls|max:7',
      'nama_matkul' => 'required',
      'pertemuan' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => false,
        'errors' => $validator->errors()->messages(),
      ]);
    } else {
      $matkul = new Matkul();
      $matkul->kode_matkul = $request->kode_matkul;
      $matkul->nama_matkul = $request->nama_matkul;
      $matkul->pertemuan = $request->pertemuan;
      $matkul->save();
      return response()->json([
        'status' => true,
        'success' => 'Mata Kuliah berhasil ditambahkan.',
      ]);
    }
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
  public function edit($id)
  {
    $matkul = Matkul::all()->find($id);
    return response()->json(['matkul' => $matkul]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateMatkulRequest  $request
   * @param  \App\Models\Matkul  $matkul
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $matkul = Matkul::all()->find($request->id);

    if ($request->kode_matkul == $matkul->kode_matkul) {
      $validator = Validator::make($request->all(), [
        'pertemuan' => 'required',
      ]);
      if ($validator->fails()) {
        return response()->json([
          'status' => false,
          'errors' => $validator->errors()->messages(),
        ]);
      } else {
        $matkul->pertemuan = $request->pertemuan;
        $matkul->save();
        return response()->json([
          'status' => true,
          'success' => 'Mata Kuliah berhasil diubah.',
        ]);
      }
    } else {
      $validator = Validator::make($request->all(), [
        'kode_matkul' => 'required|unique:matkuls|max:7',
        'nama_matkul' => 'required',
        'pertemuan' => 'required',
      ]);
      if ($validator->fails()) {
        return response()->json([
          'status' => false,
          'errors' => $validator->errors()->messages(),
        ]);
      } else {
        $matkul->kode_matkul = $request->kode_matkul;
        $matkul->nama_matkul = $request->nama_matkul;
        $matkul->pertemuan = $request->pertemuan;
        $matkul->save();
        return response()->json([
          'status' => true,
          'success' => 'Mata Kuliah berhasil di update.',
        ]);
      }
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Matkul  $matkul
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $matkul = Matkul::find($id);
    $matkul->delete();
    return response()->json([
      'status' => true,
      'success' => 'Mata Kuliah berhasil dihapus.',
    ]);
  }
}
