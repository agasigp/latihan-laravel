<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pasien;

class PasienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pasien.index', [
            'pasien' => Pasien::where('nama', 'LIKE', '%' . $request->input('q') . '%')->paginate(20),
            'request' => $request,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pasien = new Pasien();
        $pasien->no_rm = $request->input('no_rm');
        $pasien->nama = $request->input('nama');
        $pasien->jenis_kelamin = $request->input('jenis_kelamin');
        $pasien->alamat = $request->input('alamat');
        $pasien->save();

        $request->session()->flash('success_message', 'Berhasil input data!');

        return redirect()->route('pasien.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pasien.edit', [
            'pasien' => Pasien::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pasien = Pasien::find($id);
        $pasien->no_rm = $request->input('no_rm');
        $pasien->nama = $request->input('nama');
        $pasien->jenis_kelamin = $request->input('jenis_kelamin');
        $pasien->alamat = $request->input('alamat');
        $pasien->save();

        $request->session()->flash('success_message', 'Berhasil ubah data!');

        return redirect()->route('pasien.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
