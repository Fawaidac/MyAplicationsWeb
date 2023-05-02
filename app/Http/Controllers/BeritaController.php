<?php

namespace App\Http\Controllers;

use App\Models\master_berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function berita(){
        try {
            $masterBerita = master_berita::all();
            return response()->json([
                'message' => 'success',
                'data' => $masterBerita
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => [],
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
