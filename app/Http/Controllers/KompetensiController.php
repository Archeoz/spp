<?php

namespace App\Http\Controllers;

use App\Models\Kompetensi;
use Illuminate\Http\Request;

class KompetensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kompetensi = Kompetensi::all();
        return view('kompetensi.data',compact('kompetensi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerpage()
    {
        return view('kompetensi.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Kompetensi::create([
            'kompetensi_keahlian' => $request->kompetensi,
        ]);
        return redirect('datakompetensipage');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kompetensi  $kompetensi
     * @return \Illuminate\Http\Response
     */
    public function editpage($id_kompetensi)
    {
        $kompetensi = Kompetensi::where('id_kompetensi',$id_kompetensi)->first();
        return view('kompetensi.edit',compact('kompetensi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kompetensi  $kompetensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request ,$id_kompetensi)
    {
        $kompetensi = Kompetensi::where('id_kompetensi',$id_kompetensi)->update([
            'kompetensi_keahlian' => $request->kompetensi,
        ]);
        return redirect('datakompetensipage');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kompetensi  $kompetensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kompetensi $kompetensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kompetensi  $kompetensi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kompetensi)
    {
        Kompetensi::where('id_kompetensi',$id_kompetensi)->delete();
        return back();
    }
}
