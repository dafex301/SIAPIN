<?php

namespace App\Http\Controllers;

use App\Models\MhsPraktikum;
use App\Models\Lab;
use App\Models\Mahasiswa;
// use App\Http\Requests\StoreMhsPraktikumRequest;
// use App\Http\Requests\UpdateMhsPraktikumRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MhsPraktikumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allJadwal = DB::table('jadwals')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->select('jadwals.*', 'matkuls.nama_matkul')
            ->get();

        $labs = Lab::all();
        $mahasiswas = Mahasiswa::all();
        $jadwals = DB::table('mhs_praktikums')
            ->leftJoin('jadwals', 'mhs_praktikums.jadwal_id', '=', 'jadwals.id')
            ->orderBy('mhs_praktikums.id');

        return view('dashboard.mhsPraktikum.index', compact('jadwals', 'mahasiswas', 'labs', 'allJadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mhs_praktikums = DB::table('mhs_praktikums')
            ->join('mahasiswas', 'mhs_praktikums.mahasiswa_id', '=', 'mahasiswas.id')
            ->join('jadwals', 'mhs_praktikums.jadwal_id', '=', 'jadwals.id')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('labs', 'jadwals.lab_id', '=', 'labs.id')
            ->select('mahasiswas.nama', 'matkuls.*', 'jadwals.*', 'labs.nama_lab', 'mhs_praktikums.*')
            ->get();

        return response()->json([
            'mhs_praktikums' => $mhs_praktikums
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMhsPraktikumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required',
            'jadwal_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->messages(),
            ]);
        } else {
            $mhs_praktikum = new MhsPraktikum();
            $mhs_praktikum->mahasiswa_id = $request->mahasiswa_id;
            $mhs_praktikum->jadwal_id = $request->jadwal_id;
            $mhs_praktikum->isPresent = 0;
            $mhs_praktikum->save();

            return response()->json([
                'status' => true,
                // 'success' => $student_exam,
                'success' => 'Mahasiswa praktikum berhasil ditambahkan.',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MhsPraktikum  $mhsPraktikum
     * @return \Illuminate\Http\Response
     */
    public function show(MhsPraktikum $mhsPraktikum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MhsPraktikum  $mhsPraktikum
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mhs_praktikum = MhsPraktikum::all()->find($id);
        return response()->json([
            'status' => true,
            // 'success' => $id,
            'mhs_praktikum' => $mhs_praktikum,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMhsPraktikumRequest  $request
     * @param  \App\Models\MhsPraktikum  $mhsPraktikum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $mhs_praktikum = MhsPraktikum::all()->find($request->id);
        $mhs_praktikum->mahasiswa_id = $request->mahasiswa_id;
        $mhs_praktikum->jadwal_id = $request->jadwal_id;
        $mhs_praktikum->save();
        return response()->json([
            // 'success' => $student_exam,
            'success' => 'Mahasiswa praktikum berhasil di update.',
        ]);
    }

    public function updateAtt(Request $request)
    {

        // $mahasiswa_id = Mahasiswa::all()->where('nim', '=', $request->Nim)->first()->id;

        // $mhs_praktikum = MhsPraktikum::all()
        //     ->where('mahasiswa_id', '=', $mahasiswa_id)
        //     ->where('jadwal_id', '=', $request->id)
        //     ->first();

        // $mhs_praktikum->isPresent = 1;
        // $mhs_praktikum->save();
        // return response()->json([
        //     // 'success' => $student_exam,
        //     'success' => 'Mahasiswa berhasil absen.',
        // ]);
        $mahasiswa_id = Mahasiswa::all()->where('nim', '=', $request->Nim)->first()->id;

        $ms_praktikum = MhsPraktikum::all()
            ->where('mahasiswa_id', '=', $mahasiswa_id)
            ->where('jadwal_id', '=', $request->id)
            ->first();

        $ms_praktikum->isPresent = 1;
        $ms_praktikum->save();
        return response()->json([
            // 'success' => $student_exam,
            'success' => 'Mahasiswa berhasil absen.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MhsPraktikum  $mhsPraktikum
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mhs_praktikum = MhsPraktikum::find($id);
        $mhs_praktikum->delete();
        return response()->json([
            'status' => true,
            'success' => 'Mahasiswa praktikum berhasil dihapus.',
        ]);
    }
}
