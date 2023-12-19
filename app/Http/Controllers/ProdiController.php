<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodi = Prodi::all();
        //dd($prodi);
        return view ("prodi.index")->with("prodi", $prodi);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fakultas = Fakultas::all();
        return view("prodi.create")-> with("fakultas", $fakultas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //store untuk menyimpan datanya
    {
         // dd($request);
        //biar tersimpan datanya
        //validasi data input

        $this->authorize('create', Prodi::class);

        $validasi = $request->validate([
            "nama" => "required|unique:prodis",//prodis nama tabelnya
            "fakultas_id" => "required"
        ]);
        //simpan data ke tabel fakultas
        Prodi::create($validasi);

        //redirect ke fakultas/index
        return redirect("prodi")->with("success", "Data prodi berhasil disimpan");

    }

    /**
     * Display the specified resource.
     */
    public function show(Prodi $prodi)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $prodi)
    {
        $fakultas = Fakultas::all();
        return view("prodi.edit")->with("prodi", $prodi)->with("fakultas", $fakultas);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prodi $prodi)
    {
        $this->authorize('update',$prodi); //THIS ACTION IS UNAUTHORIZED.

        $validasi = $request->validate(["nama" => "required",
        "fakultas_id" => "required"]);

        $prodi->update($validasi);
        // atau pakai cara di bawah ini
        // Prodi::where('id', $prodi->id)->update($validasi);
        return redirect("prodi")->with("success", "data prodi berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prodi $prodi)
    {
        $this->authorize('delete',$prodi);//THIS ACTION IS UNAUTHORIZED.

        $prodi -> delete();
        return redirect()->route("prodi.index")->with("success", "Berhasil Dihapus");
    }
}
