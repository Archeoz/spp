<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\Kelas;
use App\Models\Kompetensi;
use App\Models\Spp;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::join('kelas','kelas.id_kelas', '=', 'siswas.id_kelas')
        ->leftJoin('spps','spps.id_spp','=','siswas.id_spp')
        ->leftJoin('kompetensis','kompetensis.id_kompetensi','=', 'siswas.id_kompetensi')
        ->select('siswas.*','kelas.*','kompetensis.*','spps.*')
        ->get();
        return view('siswa.data',compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerpage()
    {
        $kelas = Kelas::all();
        $kompetensi = Kompetensi::all();
        $spps = Spp::join('kelas','kelas.id_kelas','=','spps.id_kelas')
        ->leftJoin('kompetensis','kompetensis.id_kompetensi','=','spps.id_kompetensi')
        ->select('spps.*','kompetensis.*','kelas.*')
        ->get();
        return view('siswa.register',compact('kelas','kompetensi','spps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSiswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $spp = $request->spp;
        // return $spp;
        // $satuan = implode('.',$spp);
        // dd($satuan);
        // $insertData = [];
        // for ($i=0; $i < count($spp) ; $i++) {
        //     array_push($spp, [
        //         'nisn' => $request->nisn,
        //         'nis' => $request->nis,
        //         'password' => bcrypt($request->password),
        //         'nama_siswa' => $request->nama,
        //         'id_kelas' => $request->kelas,
        //         'id_kompetensi' => $request->kompetensi,
        //         'id_spp' => $spp[$i],
        //         'alamat' => $request->alamat,
        //         'telp' => $request->telp,
        //     ]);
        // }
        // Siswa::insertOrIgnore($insertData);
        foreach ($request->spp as $spp) {
            Siswa::updateOrInsert(
                [
                    'nisn' => $request->nisn,
                    'nis' => $request->nis,
                    'nama_siswa' => $request->nama,
                    'id_spp' => $spp,
                    'password' => bcrypt($request->password),
                    'id_kelas' => $request->kelas,
                    'id_kompetensi' => $request->kompetensi,
                    'alamat' => $request->alamat,
                    'telp' => $request->telp,
                ],
            );
        }

        return redirect('datasiswapage');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function editpage($nisn)
    {
        // dd($nisn);
        $siswa = Siswa::where('nisn',$nisn)->first();
        $kelas = Kelas::all();
        $kompetensi = Kompetensi::all();
        // dd($siswa);
        return view('siswa.edit',compact('siswa','kelas','kompetensi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $nisn)
    {
        // dd($nisn);
        if ($request->password == null) {
            Siswa::where('nisn',$nisn)->update([
                'nisn' => $request->nisn,
                'nis' => $request->nis,
                'nama_siswa' => $request->nama,
                'id_kelas' => $request->kelas,
                'id_kompetensi' => $request->kelas,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
            ]);
        } else {
            Siswa::where('nisn',$nisn)->update([
                'nisn' => $request->nisn,
                'nis' => $request->nis,
                'password' => bcrypt($request->password),
                'nama_siswa' => $request->nama,
                'id_kelas' => $request->kelas,
                'id_kompetensi' => $request->kelas,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
            ]);
        }
        return redirect('datasiswapage');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaRequest  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Siswa::where('id',$id)->delete();
        return back();
    }
}
