<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
// use App\Http\Requests\StoreMahasiswaRequest;
// use App\Http\Requests\UpdateMahasiswaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::where('nama', '!=', null)->latest()->paginate(5);

        return view('dashboard.mahasiswa.index', [
            'title' => 'Mahasiswa | SIAPIN'
        ], compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mahasiswas = Mahasiswa::where('nama', '!=', null)->latest()->paginate(5);
        return response()->json([
            'mahasiswas' => $mahasiswas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMahasiswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas|max:14',
            'email' => 'required|unique:mahasiswas|max:50',
            'phone' => 'required|unique:mahasiswas|max:14',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->messages(),
            ]);
        } else {
            $mahasiswa = new Mahasiswa;
            $mahasiswa->nama = $request->nama;
            $mahasiswa->nim = $request->nim;
            $mahasiswa->email = $request->email;
            $mahasiswa->phone = $request->phone;

            $mahasiswa->save();
            return response()->json([
                'status' => true,
                'success' => 'Berhasil menambahkan mahasiswa.',
            ]);
        }
        // return redirect('/dashboard/mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::all()->find($id);
        return response()->json(['mahasiswa' => $mahasiswa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMahasiswaRequest  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $mahasiswa = Mahasiswa::all()->find($request->id);
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nim' => 'required|max:14',
            'email' => 'required|max:50',
            'phone' => 'required|max:14',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->messages(),
            ]);
        } else {
            $mahasiswa->nama = $request->nama;
            $mahasiswa->nim = $request->nim;
            $mahasiswa->email = $request->email;
            $mahasiswa->phone = $request->phone;

            $mahasiswa->save();
            return response()->json([
                'status' => true,
                'success' => 'Berhasil update mahasiswa.',
            ]);
        }
        // update
        // $mahasiswa->update($request->all());

        // return redirect()->route('dashboard.mahasiswa.index')->with('success', 'Mahasiswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // destroy
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();
        return response()->json([
            'status' => true,
            'success' => 'Berasil menghapus mahasiswa.',
        ]);
    }
}
