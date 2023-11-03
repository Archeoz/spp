<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Deklarasi variabel global sebagai property


    public function sesinisn(Request $request)
    {
        if ($request->has('nisn')) {
            $nisn = $request->nisn;
            $sesinisn = session()->get('sesinisn',[]);
            $sesinisn[$nisn] =[
                'nisn' => $nisn,
            ];
            session()->put('sesinisn',$sesinisn);
        } else {
            return back();
        }

        return redirect('registerpembayaranpage');
    }

    public function batalpembayaran()
    {
        session()->forget('sesinisn');
        return redirect('dashboard');
    }

   public function buatsession(Request $request)
    {
        if ($request->has('spp')) {
            $id_spp = $request->spp;
            // dd($id_spp);
            $spp = Spp::where('id_spp', $id_spp)->first();
            $kelas = Spp::join('kelas', 'kelas.id_kelas', '=', 'spps.id_kelas')
                ->leftJoin('kompetensis', 'kompetensis.id_kompetensi', '=', 'spps.id_kompetensi')
                ->where('spps.id_spp', '=', $spp->id_spp)
                // ->orWhere('spps.id_kompetensi', '=', $spp->id_kompetensi)
                ->select('spps.*', 'kelas.*', 'kompetensis.*')
                ->first();
            // dd($kelas);

            $pilihanspp = session()->get('pilihanspp', []);

            if (isset($pilihanspp[$id_spp])) {
                return back();
            } else {
                $pilihanspp[$id_spp] = [
                    'id_spp' => $id_spp,
                    'bulan' => $kelas->bulan,
                    'tahun' => $kelas->tahun,
                    'kelas' => $kelas->nama_kelas,
                    'kompetensi' => $kelas->kompetensi_keahlian,
                    'nominal' => $kelas->nominal,
                ];
            }

            session()->put('pilihanspp', $pilihanspp);

        } else {
            return back();
        }
        $test = session()->get('pilihanspp');
        return back();
    }



    public function hapussesi($id_spp)
    {
        // dd($id_spp);
        $pilihanspp = session()->get('pilihanspp');
        // dd($pilihanspp); // Check the current contents of pilihanspp
        unset($pilihanspp[$id_spp]);
        session()->put('pilihanspp', $pilihanspp);
        // dump($pilihanspp); // Check the contents after unsetting
        return back();

    }
    public function hapussemua()
    {
        session()->forget('pilihanspp');
        return back();
    }

    public function tampilnisn()
    {
        return view('pembayaran.insertnisn');
    }

    public function registerpage()
    {
        $sesinisn = session()->get('sesinisn');

        // return $sesinisn;

        $siswa = Siswa::join('kelas','kelas.id_kelas','=','siswas.id_kelas')
        ->join('kompetensis','kompetensis.id_kompetensi','=','siswas.id_kompetensi')
        ->where('siswas.nisn', $sesinisn)
        ->select('kelas.*', 'siswas.*', 'kompetensis.*')
        ->get();

        $idspp = [];
        foreach ($siswa as $siswa) {
            $idspp[] = $siswa->id_spp;
        }
        // dd($idspp);
        $spp = Spp::join('kelas', 'kelas.id_kelas','=','spps.id_kelas')
        ->leftJoin('kompetensis','kompetensis.id_kompetensi','=','spps.id_kompetensi')
        ->whereIn('spps.id_spp',$idspp)
        ->select('kelas.*','spps.*','kompetensis.*')
        ->get();
        return view('pembayaran.register',compact('siswa','spp'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function kirimspp(Request $request)
    {
        $user = Auth::guard('petugas')->user();
        // dd($user);
        dd($request->nisn);
        $sesispp = session()->get('pilihanspp');
        $id_siswa = Siswa::where('nisn','=',$request->nisn)->first();
        foreach ($sesispp as $key => $value) {
            $id_spp = $value['id_spp'];

            Pembayaran::updateOrInsert(
                [
                    'id_siswa' => $id_siswa,
                    'id_spp' => $id_spp,
                ],
                [
                    'id_petugas' => $user->id,
                    'tgl_bayar' => now(),
                    'jumlah_bayar' => $request->total,
                ]
            );
        }
        if (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'admin') {
            session()->forget('pilihanspp');
            return redirect('histori');
        } elseif (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'petugas') {
            session()->forget('pilihanspp');
            return redirect('historipetugas');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // return "tais";
        if (Auth::guard('petugas')->user()) {
            if (Auth::guard('petugas')->user()->level == 'admin') {
                $histori = Pembayaran::join('petugas','petugas.id','=','pembayarans.id_petugas')
                ->join('siswas','siswas.id','=','pembayarans.id_siswa')
                ->join('kelas','kelas.id_kelas','=','siswas.id_kelas')
                ->join('kompetensis','kompetensis.id_kompetensi','=','siswas.id_kompetensi')
                ->join('spps','spps.id_spp','=','pembayarans.id_spp')
                ->select('pembayarans.*','petugas.*','siswas.*','kompetensis.*','spps.*','kelas.*')
                ->get();
            } elseif (Auth::guard('petugas')->user()->level == 'petugas') {
                $petugas = Auth::guard('petugas')->user();
                // dd($petugas);
                $histori = Pembayaran::join('petugas','petugas.id','=','pembayarans.id_petugas')
                ->join('siswas','siswas.id','=','pembayarans.id_siswa')
                ->join('kelas','kelas.id_kelas','=','siswas.id_kelas')
                ->join('kompetensis','kompetensis.id_kompetensi','=','siswas.id_kompetensi')
                ->join('spps','spps.id_spp','=','pembayarans.id_spp')
                ->where('pembayarans.id_petugas',$petugas->id)
                ->select('pembayarans.*','petugas.*','siswas.*','kompetensis.*','spps.*','kelas.*')
                ->get();
            }
        } elseif (Auth::guard('siswa')->user()) {
            $siswa = Auth::guard('siswa')->user();
            $histori = Pembayaran::join('petugas','petugas.id','=','pembayarans.id_petugas')
                ->join('siswas','siswas.id','=','pembayarans.id_siswa')
                ->join('kelas','kelas.id_kelas','=','siswas.id_kelas')
                ->join('kompetensis','kompetensis.id_kompetensi','=','siswas.id_kompetensi')
                ->join('spps','spps.id_spp','=','pembayarans.id_spp')
                ->where('pembayarans.id_siswa',$siswa->id)
                ->select('pembayarans.*','petugas.*','siswas.*','kompetensis.*','spps.*','kelas.*')
                ->get();
        }
        return view('history',compact('histori'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }
}
