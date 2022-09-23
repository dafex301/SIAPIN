<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\Lab;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
// use App\Http\Requests\StoreJadwalRequest;
// use App\Http\Requests\UpdateJadwalRequest;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matkul = Matkul::all();
        $lab = Lab::all();

        $jadwals = DB::table('jadwals')
            ->leftJoin('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->orderBy('jadwals.matkul_id');

        return view('dashboard.jadwal.index', compact('jadwals', 'matkul', 'lab'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jadwals = DB::table('jadwals')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('labs', 'jadwals.lab_id', '=', 'labs.id')
            ->select('jadwals.*', 'matkuls.nama_matkul', 'labs.nama_lab', 'labs.lantai')
            ->get();

        return response()->json([
            'jadwals' => $jadwals
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJadwalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'matkul_id' => 'required',
            'lab_id' => 'required',
            // 'day' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->messages(),
            ]);
        } else {
            $jadwal = new Jadwal();
            $jadwal->matkul_id = $request->matkul_id;
            $jadwal->lab_id = $request->lab_id;
            $jadwal->start = $request->start;
            $jadwal->end = $request->end;

            $jadwal->save();
            return response()->json([
                'status' => true,
                'success' => 'Jadwal berhasil ditambahkan.',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jadwal = Jadwal::all()->find($id);
        return response()->json(['jadwal' => $jadwal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJadwalRequest  $request
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $validator = Validator::make($request->all(), [
            'matkul_id' => 'required',
            'lab_id' => 'required',
            // 'day' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->messages(),
            ]);
        } else {
            $jadwal = Jadwal::all()->find($request->id);
            $jadwal->matkul_id = $request->matkul_id;
            $jadwal->lab_id = $request->lab_id;
            $jadwal->start = $request->start;
            $jadwal->end = $request->end;

            $jadwal->save();
            return response()->json([
                'status' => true,
                'success' => 'Jadwal berhasil diupdate.',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->delete();
        return response()->json([
            'status' => true,
            'success' => 'Jadwal berhasil dihapus.',
        ]);
    }

    public function inputJadwal($id)
    {
        $jadwal = Jadwal::all()->find($id);
        $matkul = Matkul::all()->find($jadwal->matkul_id);

        $jadwals = DB::table('jadwals')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->where('jadwals.id', '=', $id)
            ->select('matkuls.nama_matkul')
            ->get();
        $nama = $jadwals->first()->nama_matkul;

        $mhs_praktikums = DB::table('mhs_praktikums')
            ->join('mahasiswas', 'mhs_praktikums.mahasiswa_id', '=', 'mahasiswas.id')
            ->join('jadwals', 'mhs_praktikums.jadwal_id', '=', 'jadwals.id')
            ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
            ->join('labs', 'jadwals.lab_id', '=', 'labs.id')
            ->where('matkuls.nama_matkul', '=', $nama)
            ->select('mhs_praktikums.*', 'mahasiswas.nama', 'matkuls.*', 'jadwals.*', 'labs.nama_lab')
            ->get();
        return view('dashboard.jadwal.inputJadwal', compact('matkul', 'id', 'mhs_praktikums'));

        // $jadwal = Jadwal::all()->find($id);
        // $matkul = Matkul::all()->find($jadwal->matkul_id);

        // $jadwals = DB::table('jadwals')
        //     ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
        //     ->where('jadwals.id', '=', $id)
        //     ->select('matkuls.nama_matkul')
        //     ->get();
        // $name = $jadwals->first()->nama_matkul;

        // $mhs_praktikums = DB::table('mhs_praktikums')
        //     ->join('mahasiswas', 'mhs_praktikums.mahasiswa_id', '=', 'mahasiswas.id')
        //     ->join('jadwals', 'mhs_praktikums.jadwal_id', '=', 'jadwals.id')
        //     ->join('matkuls', 'jadwals.matkul_id', '=', 'matkuls.id')
        //     ->join('labs', 'jadwals.lab_id', '=', 'labs.id')
        //     ->where('matkuls.nama_matkul', '=', $name)
        //     ->select('mhs_praktikums.*', 'mahasiswas.nama', 'matkuls.*', 'jadwals.*', 'labs.nama_lab')
        //     ->get();
        // return view('dashboard.jadwal.inputJadwal', compact('matkul', 'id', 'mhs_praktikums'));
    }
}
