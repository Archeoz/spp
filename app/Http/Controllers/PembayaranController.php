<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\KelasSpp;
use App\Models\Pembayaran;
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

    public function sesihistori(Request $request)
    {
        session()->forget('historisiswa');
        if ($request->has('nisn')) {
            $nisn = $request->nisn;
            $dataSiswa = Siswa::join('kelas','kelas.id_kelas','siswas.id_kelas')
            ->join('kompetensis','kompetensis.id_kompetensi','siswas.id_kompetensi')
            ->where('nisn', $nisn)
            ->select('siswas.*','kompetensis.*','kelas.*')
            ->first();

            $spps = KelasSpp::where('id_kelas',$dataSiswa->id_kelas)
            ->where('id_kompetensi',$dataSiswa->id_kompetensi)
            ->get();

            $idsppSiswa = [];
            foreach ($spps as $spps) {
                $idsppSiswa[] = $spps->id_spp;
            }
            // dd($idsppSiswa);
            $dataHistori = Pembayaran::join('siswas', 'siswas.nisn', 'pembayarans.nisn')
                ->where('siswas.nisn', $nisn)
                ->select('pembayarans.*')
                ->get();
            // $dataHistori = Pembayaran::all();
            $idsppHistori = [];
            // dd($dataHistori);
            foreach ($dataHistori as $data) {
                $idsppHistori[] = $data->id_spp;
            }
            // dd($idsppHistori);
            // Cari id_spp yang ada di tabel siswa tapi tidak ada di tabel riwayat
            $missingIdSpp = array_diff($idsppSiswa, $idsppHistori);
            // dd($missingIdSpp);

            $tagihan = [];
            foreach ($missingIdSpp as $value) {
                $tagihanSpp = Spp::where('id_spp', $value)
                    ->get();

                foreach ($tagihanSpp as $key) {
                    $tagihan[] = [
                        'bulan' => $key->bulan,
                        'tahun' => $key->tahun,
                        'nominal' => $key->nominal,
                    ];
                }
            }
            $sesihistori = session()->get('historisiswa', []);
            foreach ($tagihan as $key) {
                $sesihistori[] = [
                    'nisn' => $dataSiswa->nisn, // Access the first element directly
                    'nis' => $dataSiswa->nis, // Access the first element directly
                    'nama_siswa' => $dataSiswa->nama_siswa, // Access the first element directly
                    'nama_kelas' => $dataSiswa->nama_kelas,
                    'kompetensi_keahlian' => $dataSiswa->kompetensi_keahlian,
                    'bulan' => $key['bulan'],
                    'tahun' => $key['tahun'],
                    'nominal' => $key['nominal'],
                ];
            }
            // dd($sesihistori);
            session()->put('historisiswa', $sesihistori);
            return back();
        } else {
            session()->forget('historisiswa');
            return back();
        }
    }

    public function hapussesihistori()
    {
        session()->forget('historisiswa');
        return back();
    }

    public function sesinisn(Request $request)
    {
        if ($request->has('nisn')) {
            $nisn = $request->nisn;
            $sesinisn = session()->get('sesinisn', []);
            $sesinisn[$nisn] = [
                'nisn' => $nisn,
            ];
            session()->put('sesinisn', $sesinisn);
        } else {
            return back();
        }
        if (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'admin') {
            return redirect('registerpembayaranpage');
        } elseif (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'petugas') {
            return redirect('registerpembayaranpagepetugas');
        }
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

            // dd($kelas);

            $pilihanspp = session()->get('pilihanspp', []);

            if (isset($pilihanspp[$id_spp])) {
                return back();
            } else {
                $pilihanspp[$id_spp] = [
                    'id_spp' => $id_spp,
                    'bulan' => $spp->bulan,
                    'tahun' => $spp->tahun,
                    'nominal' => $spp->nominal,
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
        // $nisnCollection = Siswa::select('nisn', 'nis', 'nama_siswa')
        //     ->distinct()
        //     ->get();

        // $nisnsaja = $nisnCollection->pluck('nisn')->toArray();

        // $subquery = Siswa::select('nisn')
        //     ->distinct()
        //     ->get();

        $siswas = Siswa::join('kelas', 'kelas.id_kelas', '=', 'siswas.id_kelas')
            ->join('kompetensis', 'kompetensis.id_kompetensi', '=', 'siswas.id_kompetensi')
            // ->whereIn('siswas.nisn', $subquery->pluck('nisn')->toArray())
            ->select('siswas.*', 'kelas.nama_kelas', 'kompetensis.kompetensi_keahlian')
            ->get();

        // dd($siswas);


        // $nisn = Siswa::select('nisn', 'nis', 'nama_siswa')
        //     ->distinct()
        //     ->get();
        // $nisnsaja = [];
        // foreach ($nisn as $key => $value) {
        //     $nisnsaja[] = [
        //         'nisn' => $nisn[$key]->nisn,
        //     ];
        // }
        // $siswas = [];
        // foreach ($nisnsaja as $key => $value) {
        //     $siswa = Siswa::join('kelas', 'kelas.id_kelas', '=', 'siswas.id_kelas')
        //     ->join('kompetensis', 'kompetensis.id_kompetensi', '=', 'siswas.id_kompetensi')
        //     ->where('siswas.nisn',$nisnsaja[$key]['nisn'])
        //     ->select('siswas.*', 'kelas.nama_kelas', 'kompetensis.kompetensi_keahlian')
        //     ->groupBy('siswas.id')
        //     ->get();
        //     $siswas = array_merge($siswas, $siswa->toArray());
        // }
        // dd($siswas);

        // $siswas = [];
        // // dd($siswa);
        // foreach ($nisn as $key => $value) {

        //     $siswas[] = [
        //         'nisn' => $value->nisn,
        //         'nis' => $value->nis,
        //         'nama_siswa' => $value->nama_siswa,
        //         'nama_kelas' => $siswas[$key]->nama_kelas, // Access the property using the index
        //         'kompetensi_keahlian' => $siswas[$key]->kompetensi_keahlian, // Access the property using the index
        //     ];
        // }

        // dd($siswas);

        return view('pembayaran.insertnisn', compact('siswas'));
    }

    public function registerpage()
    {
        $sesinisn = session()->get('sesinisn');

        // return $sesinisn;

        $siswa = Siswa::join('kelas', 'kelas.id_kelas', '=', 'siswas.id_kelas')
            ->join('kompetensis', 'kompetensis.id_kompetensi', '=', 'siswas.id_kompetensi')
            ->where('siswas.nisn', $sesinisn)
            ->select('kelas.*', 'siswas.*', 'kompetensis.*')
            ->first();

        $spps = KelasSpp::where('id_kelas', '=', $siswa->id_kelas)
            ->where('id_kompetensi', '=', $siswa->id_kompetensi)
            ->get();

        // $spps = KelasSpp::where('id_kelas', $siswa->id_kelas)
        //     ->where(function ($query) use ($siswa) {
        //         $query->where('id_kompetensi', '!=', $siswa->id_kompetensi)
        //             ->orWhereNull('id_kompetensi');
        //     })
        //     ->get();

        $idspps = [];
        foreach ($spps as $data) {
            $idspps[] = $data->id_spp;
        }

        $dataHistori = Pembayaran::join('siswas', 'siswas.nisn', 'pembayarans.nisn')
            ->where('siswas.nisn', $sesinisn)
            ->select('pembayarans.*')
            ->get();

        $idsppHistori = [];
        // dd($dataHistori);
        foreach ($dataHistori as $data) {
            $idsppHistori[] = $data->id_spp;
        }
        // dd($idsppHistori);
        // Cari id_spp yang ada di tabel siswa tapi tidak ada di tabel riwayat
        $missingIdSpp = array_diff($idspps, $idsppHistori);
        // dd($missingIdSpp);

        $spp = [];
        foreach ($missingIdSpp as $value) {
            $tagihanSpp = Spp::where('id_spp', $value)
                ->get();

            foreach ($tagihanSpp as $key) {
                $spp[] = [
                    'id_spp' => $key->id_spp,
                    'bulan' => $key->bulan,
                    'tahun' => $key->tahun,
                    'nominal' => $key->nominal,
                ];
            }
        }

        return view('pembayaran.register', compact('siswa','spp'));
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
        // dd($request->nisn);
        $sesispp = session()->get('pilihanspp');
        $nisn = $request->nisn;
        // $ceknisn = Siswa::where('nisn', '=', $request->nisn)->first();
        // $id_siswa = $ceknisn->id;
        foreach ($sesispp as $key => $value) {
            $id_spp = $value['id_spp'];

            Pembayaran::updateOrInsert(
                [
                    'nisn' => $nisn,
                    'id_spp' => $id_spp,
                ],
                [
                    'id_petugas' => $user->id,
                    'tgl_bayar' => now(),
                    'jumlah_bayar' => $request->total,
                ],
            );
        }
        if (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'admin') {
            session()->forget('pilihanspp');
            session()->forget('sesinisn');
            return redirect('histori');
        } elseif (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'petugas') {
            session()->forget('pilihanspp');
            session()->forget('sesinisn');
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
                $histori = Pembayaran::join('petugas', 'petugas.id', '=', 'pembayarans.id_petugas')
                    ->join('siswas', 'siswas.nisn', '=', 'pembayarans.nisn')
                    ->join('kelas', 'kelas.id_kelas', '=', 'siswas.id_kelas')
                    ->join('kompetensis', 'kompetensis.id_kompetensi', '=', 'siswas.id_kompetensi')
                    ->join('spps', 'spps.id_spp', '=', 'pembayarans.id_spp')
                    ->select('pembayarans.*', 'petugas.*', 'siswas.*', 'kompetensis.*', 'spps.*', 'kelas.*')
                    ->get();

                $nisn = Siswa::select('nisn', 'nis', 'nama_siswa')
                    ->distinct()
                    ->get();

                $siswa = Siswa::join('kelas', 'kelas.id_kelas', '=', 'siswas.id_kelas')
                    ->join('kompetensis', 'kompetensis.id_kompetensi', '=', 'siswas.id_kompetensi')
                    ->select('siswas.*', 'kelas.nama_kelas', 'kompetensis.kompetensi_keahlian')
                    ->get();

                $siswas = [];

                foreach ($nisn as $key => $value) {
                    $siswas[] = [
                        'nisn' => $value->nisn,
                        'nis' => $value->nis,
                        'nama_siswa' => $value->nama_siswa,
                        'nama_kelas' => $siswa[$key]->nama_kelas, // Access the property using the index
                        'kompetensi_keahlian' => $siswa[$key]->kompetensi_keahlian, // Access the property using the index
                    ];
                }
                return view('history', compact('histori', 'siswas'));
            } elseif (Auth::guard('petugas')->user()->level == 'petugas') {
                $petugas = Auth::guard('petugas')->user();
                // dd($petugas);
                $histori = Pembayaran::join('petugas', 'petugas.id', '=', 'pembayarans.id_petugas')
                    ->join('siswas', 'siswas.id', '=', 'pembayarans.id_siswa')
                    ->join('kelas', 'kelas.id_kelas', '=', 'siswas.id_kelas')
                    ->join('kompetensis', 'kompetensis.id_kompetensi', '=', 'siswas.id_kompetensi')
                    ->join('spps', 'spps.id_spp', '=', 'pembayarans.id_spp')
                    ->where('pembayarans.id_petugas', $petugas->id)
                    ->select('pembayarans.*', 'petugas.*', 'siswas.*', 'kompetensis.*', 'spps.*', 'kelas.*')
                    ->get();
                $nisn = Siswa::select('nisn', 'nis', 'nama_siswa')
                    ->distinct()
                    ->get();

                $siswa = Siswa::join('kelas', 'kelas.id_kelas', '=', 'siswas.id_kelas')
                    ->join('kompetensis', 'kompetensis.id_kompetensi', '=', 'siswas.id_kompetensi')
                    ->select('siswas.*', 'kelas.nama_kelas', 'kompetensis.kompetensi_keahlian')
                    ->get();

                $siswas = [];

                foreach ($nisn as $key => $value) {
                    $siswas[] = [
                        'nisn' => $value->nisn,
                        'nis' => $value->nis,
                        'nama_siswa' => $value->nama_siswa,
                        'nama_kelas' => $siswa[$key]->nama_kelas, // Access the property using the index
                        'kompetensi_keahlian' => $siswa[$key]->kompetensi_keahlian, // Access the property using the index
                    ];
                }
                return view('history', compact('histori', 'siswas'));
            }
        } elseif (Auth::guard('siswa')->user()) {
            $siswa = Auth::guard('siswa')->user();
            $histori = Pembayaran::join('petugas', 'petugas.id', '=', 'pembayarans.id_petugas')
                ->join('siswas', 'siswas.nisn', '=', 'pembayarans.nisn')
                ->join('kelas', 'kelas.id_kelas', '=', 'siswas.id_kelas')
                ->join('kompetensis', 'kompetensis.id_kompetensi', '=', 'siswas.id_kompetensi')
                ->join('spps', 'spps.id_spp', '=', 'pembayarans.id_spp')
                ->where('pembayarans.nisn', $siswa->nisn)
                ->select('pembayarans.*', 'petugas.*', 'siswas.*', 'kompetensis.*', 'spps.*', 'kelas.*')
                ->get();

            $nisn = $siswa->nisn;
            $dataSiswa = Siswa::where('nisn', $nisn)->first();
            $spps = KelasSpp::where('id_kelas',$dataSiswa->id_kelas)
            ->where('id_kompetensi',$dataSiswa->id_kompetensi)
            ->get();

            $idsppSiswa = [];
            foreach ($spps as $spp) {
                $idsppSiswa[] = $spp->id_spp;
            }
            // dd($idsppSiswa);
            $dataHistori = Pembayaran::join('siswas', 'siswas.nisn', 'pembayarans.nisn')
                ->where('siswas.nisn', $nisn)
                ->select('pembayarans.*')
                ->get();
            // $dataHistori = Pembayaran::all();
            $idsppHistori = [];
            // dd($dataHistori);
            foreach ($dataHistori as $data) {
                $idsppHistori[] = $data->id_spp;
            }
            // dd($idsppHistori);
            // Cari id_spp yang ada di tabel siswa tapi tidak ada di tabel riwayat
            $missingIdSpp = array_diff($idsppSiswa, $idsppHistori);
            // dd($missingIdSpp);

            $tagihan = [];
            foreach ($missingIdSpp as $value) {
                $tagihanSpp = Spp::where('id_spp', $value)
                    ->get();

                foreach ($tagihanSpp as $key) {
                    $tagihan[] = [
                        'bulan' => $key->bulan,
                        'tahun' => $key->tahun,
                        'nominal' => $key->nominal,
                    ];
                }
            }
            return view('history', compact('histori', 'tagihan'));
        }
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
