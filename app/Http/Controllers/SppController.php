<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Spp;
use App\Models\Kelas;
use App\Models\Kompetensi;
use DateTime;
use Illuminate\Http\Request;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spp = Spp::all();
        // dd($spp);
        return view('spp.data',compact('spp'));
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
        return view('spp.register',compact('kelas','kompetensi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bulan = $request->bulan;
        //konversi bulan yang awalnya angka menjadi nama bulan
        $parsedDate = Carbon::parse($bulan);
        $bulan = $parsedDate->format('F');
        //ambil hanya tahun
        $tahun = $parsedDate->format('Y');

        Spp::create([
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nominal' => $request->nominal,
        ]);


        return redirect('dataspppage');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function editpage($id_spp)
    {

        $spp =Spp::where('id_spp',$id_spp)->first();

        // Konversi nama bulan ke bulan angka
        $bulan = new DateTime($spp->bulan);
        $angkaBulan = $bulan->format('m');
        $tahun = $spp->tahun;
        // Menggabungkan bulan dan tahun
        $bulanTahun = Carbon::create($tahun, $angkaBulan);
        $bulanTahun = $bulanTahun->format('Y-m');
        // return $bulanTahun;
        return view('spp.edit',compact('spp','bulanTahun'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request ,$id_spp)
    {
        $bulan = $request->bulan;
        //konversi bulan yang awalnya angka menjadi nama bulan
        $parsedDate = Carbon::parse($bulan);
        $bulan = $parsedDate->format('F');
        //ambil hanya tahun
        $tahun = $parsedDate->format('Y');
            Spp::where('id_spp',$id_spp)->update([
                'bulan' => $bulan,
                'tahun' => $tahun,
                'nominal' => $request->nominal,
            ]);

        return redirect('dataspppage');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spp $spp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_spp)
    {
        Spp::where('id_spp',$id_spp)->delete();
        return back();
    }
}
