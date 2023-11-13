<?php

namespace App\Http\Controllers;

use App\Models\Generate;

use Barryvdh\DomPDF\PDF;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class GenerateController extends Controller
{
    public function tampilgenerate()
    {
        $generate = Pembayaran::join('petugas','petugas.id','=','pembayarans.id_petugas')
        ->join('siswas','siswas.id','=','pembayarans.id_siswa')
        ->join('kelas','kelas.id_kelas','=','siswas.id_kelas')
        ->join('kompetensis','kompetensis.id_kompetensi','=','siswas.id_kompetensi')
        ->join('spps','spps.id_spp','=','pembayarans.id_spp')
        ->select('pembayarans.*','petugas.*','siswas.*','kompetensis.*','spps.*','kelas.*')
        ->get();

        $nisn = Siswa::select('nisn','nama_siswa')->distinct()->get();
        // dd($nisn);
        foreach ($nisn as $key => $value) {
            $
        }
        return view('generate.generate',compact('generate'));
    }

    public function cetak()
    {
        $generate = Pembayaran::join('petugas','petugas.id','=','pembayarans.id_petugas')
        ->join('siswas','siswas.id','=','pembayarans.id_siswa')
        ->join('kelas','kelas.id_kelas','=','siswas.id_kelas')
        ->join('kompetensis','kompetensis.id_kompetensi','=','siswas.id_kompetensi')
        ->join('spps','spps.id_spp','=','pembayarans.id_spp')
        ->select('pembayarans.*','petugas.*','siswas.*','kompetensis.*','spps.*','kelas.*')
        ->get();

        $namaFile = 'laporanSpp_' . date('Ymd'). '.pdf';
        // return view('generate.cetak',compact('generate'));
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('generate.cetak', compact('generate'));
        return $pdf->download($namaFile);
    }
}
