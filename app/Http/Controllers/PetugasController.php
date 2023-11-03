<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petugas = Petugas::all();
        return view('petugas.data',compact('petugas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function registerpage()
    {
        return view('petugas.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        Petugas::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'nama_petugas' => $request->nama_petugas,
            'level' => $request->level,
        ]);
        return redirect('datapetugaspage');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function editpage($id)
    {
        $petugas = Petugas::where('id',$id)->first();
        return view('petugas.edit',compact('petugas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        if ($request->password == null) {
            Petugas::where('id',$id)->update([
                'username' => $request->username,
                'nama_petugas' => $request->nama_petugas,
                'level' => $request->level,
            ]);
        } else {
            Petugas::where('id',$id)->update([
                'username' => $request->username,
                'password' => $request->password,
                'nama_petugas' => $request->nama_petugas,
                'level' => $request->level,
            ]);
        }
        return redirect('datapetugaspage');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Petugas $petugas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $petugas = Petugas::where('id',$id)->get();
        $level = Petugas::where('level',$petugas[0]['level']);
        $hitung = $level->count();

        if ($hitung == 1) {
            return back()->with('warning', 'Data hanya 1, tidak bisa dihapus');
        } else {
            Petugas::where('id',$id)->delete();
            return back();
        }

    }
}
