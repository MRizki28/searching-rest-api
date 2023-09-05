<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function getAllData()
    {
        $data = MahasiswaModel::all();
        return response()->json([
            'data' => $data
        ]);
    }

    public function searching(Request $request)
    {
        $keyword = $request->input('keyword');

        if (!$keyword) {
            return response()->json([
                'message' => 'keywrod is required or valid'
            ]);
        }
        try {
            $data = MahasiswaModel::where('nama_mahasiswa', 'like', '%' . $keyword . '%')->get();
            if ($data->isEmpty()) {
                return response()->json([
                    'message' => 'data not found or not match'
                ]);
            } else {
                return response()->json([
                    'message' => 'success',
                    'data' => $data
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'failed',
                'errors' => $th->getMessage()
            ]);
        }
    }
}
