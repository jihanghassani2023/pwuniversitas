<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FakultasController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::all();
        return response()->json($fakultas, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validate = $request->validate(['nama' => 'required|unique:fakultas']);


        Fakultas::create($validate);
        $response['success'] = true;
        $response['message'] = 'Fakultas berhasil disimpan';
        return response()->json($response, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama' => 'required'
        ]);

        $fakultas = Fakultas::where('id', $id)->update($validate);
        if ($fakultas) {
            $response['success'] = true;
            $response['message'] = 'Fakultas berhasil diperbarui.';
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response['success'] = false;
            $response['message'] = 'Fakultas gagal diperbarui.';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy($id)
    {
        $fakultas = Fakultas::where('id', $id);
        if(count($fakultas->get())>0){
            $prodi = Prodi::where('fakultas_id', $id)->get();
            if(count($prodi)>0){
                $response['success'] = false;
                $response['message'] = 'Data fakultas tidak diizinkan dihapus dikarenakan digunakan di tabel prodi';
                return response()->json($response, Response::HTTP_NOT_FOUND);
            } else{
                $fakultas->delete();
                $response['success'] = true;
                $response['message'] = 'Fakultas berhasil dihapus.';
                return response()->json($response, Response::HTTP_OK);
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Fakultas tidak ditemukan.';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }
    }
}
