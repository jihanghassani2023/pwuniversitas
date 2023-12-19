<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MahasiswaController extends Controller
{
    public function index(){
        $mahasiswa = Mahasiswa::with('prodi.fakultas')->get();
        return response()->json($mahasiswa, Response::HTTP_OK);
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            "npm" => "required|unique:mahasiswas",
            "nama" => "required",
            "tempat_lahir" => "required",
            "tanggal_lahir" => "required",
            "jk" => "required",
            "prodi_id" => "required",
            "foto" => "required|image",]);

             //ambil extensi file foto
        $ext = $request->foto->getClientOriginalExtension();

        //rename file foto menjadi npm.extensi (contoh: 2226250091.jpg)
        $validate["foto"] = $request->npm.".".$ext;

        //upload file foto ke dalam folder public/foto
        $request->foto->move(public_path('images'), $validate["foto"]);


        Mahasiswa::create($validate);
        $response['success'] = true;
        $response['message'] = 'mahasiswa berhasil disimpan';
        return response()->json($response, Response::HTTP_CREATED);
    }

    public function update(Request $request,Mahasiswa $mahasiswa)
    {
        $validate = $request->validate([
            "npm" => "required|unique:mahasiswas",
            "nama" => "required",
            "tempat_lahir" => "required",
            "tanggal_lahir" => "required",
            "jk" => "required",
            "prodi_id" => "required",
            "foto" => "required|image",]);

        $mahasiswa = Mahasiswa::where('id', $mahasiswa)->update($validate);
        if ($mahasiswa) {
            $response['success'] = true;
            $response['message'] = 'Fakultas berhasil diperbarui.';
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response['success'] = false;
            $response['message'] = 'Fakultas gagal diperbarui.';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa = Mahasiswa::where('id', $mahasiswa)->delete();
        if ($mahasiswa) {
            $response['success'] = true;
            $response['message'] = 'Fakultas berhasil dihapus.';
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response['success'] = false;
            $response['message'] = 'Fakultas tidak ditemukan.';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }
    }
}

