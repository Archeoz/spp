<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasSpp;
use App\Models\Kompetensi;
use App\Models\Spp;
use Illuminate\Http\Request;

class KelasSppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spp = Spp::all();
        $kelas = Kelas::all();
        $kompetensi = Kompetensi::all();

        $kelasspp = KelasSpp::join('kelas', 'kelas.id_kelas', '=', 'kelasspps.id_kelas')
            ->leftJoin('kompetensis', 'kompetensis.id_kompetensi', '=', 'kelasspps.id_kompetensi')
            ->join('spps', 'spps.id_spp', '=', 'kelasspps.id_spp')
            ->select('kelas.*', 'kompetensis.*', 'spps.*', 'kelasspps.*')
            ->get();

        // dd($kelasspp);
        return view('kelasSpp.data', compact('kelasspp', 'spp', 'kelas', 'kompetensi'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('kompetensi')) {
            foreach ($request->spp as $key => $value) {
                KelasSpp::updateOrInsert([
                    'id_kelas' => $request->kelas,
                    'id_kompetensi' => $request->kompetensi,
                    'id_spp' => $value,
                ]);
            }
        } elseif($request->kompetensi == null) {
            foreach ($request->spp as $key => $value) {
                KelasSpp::updateOrInsert([
                    'id_kelas' => $request->kelas,
                    'id_spp' => $value,
                ]);
            }
        }


        return redirect('datakelasspppage');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kelasspp)
    {
        KelasSpp::where('id_kelasspp', '=', $id_kelasspp)->delete();
        return back();
    }
}
