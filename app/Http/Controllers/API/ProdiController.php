<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProdiController extends Controller
{
    public function index()
    {
        $prodi = Prodi::with('fakultas')->get();
        return response()->json($prodi, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required|unique:prodis',
            'fakultas_id' => 'required']);


        Prodi::create($validate);
        $response['success'] = true;
        $response['message'] = 'Prodi berhasil disimpan';
        return response()->json($response, Response::HTTP_CREATED);
    }
    public function update(Request $request, Prodi $prodi)
    {
        $validate = $request->validate([
            'nama' => 'required'
        ]);

        $prodi = Prodi::where('id', $prodi)->update($validate);
        if ($prodi) {
            $response['success'] = true;
            $response['message'] = 'Fakultas berhasil diperbarui.';
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response['success'] = false;
            $response['message'] = 'Fakultas gagal diperbarui.';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy(Prodi $prodi)
    {
        $prodi = Prodi::where('id', $prodi);
        if(count($prodi->get())>0){
            $mahasiswa = Mahasiswa::where('prodi_id', $prodi)->get();
            if(count($mahasiswa)>0){
                $response['success'] = false;
                $response['message'] = 'Data prodi tidak diizinkan dihapus dikarenakan digunakan di tabel prodi';
                return response()->json($response, Response::HTTP_NOT_FOUND);
            } else{
                $prodi->delete();
                $response['success'] = true;
                $response['message'] = 'Prodi berhasil dihapus.';
                return response()->json($response, Response::HTTP_OK);
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Prodi tidak ditemukan.';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }
    }
}

