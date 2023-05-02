<?php

namespace App\Http\Controllers;

use App\Models\pengajuan_surat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function pengajuan(Request $request){
    $request->validate([
        'id' =>'required',
        'status' => 'required',
        'keterangan' => 'required',
        'id_surat' => 'required',
    ]);

    $existingSurat = pengajuan_surat::where('id_surat', $request->id_surat)
                                    ->where('id', $request->id)
                                    ->first();  

    if (!$existingSurat) {
        $data = pengajuan_surat::create([
            'uuid' => Str::uuid(),
            'status' => 'Diajukan',
            'keterangan' => $request->keterangan,
            'id_surat' => $request->id_surat,
            'id' => $request->id,
        ]);

        return response()->json([
            'message' => 'Berhasil mengajukan surat',
            'data' => $data
        ], 200);
    } else {
        $cek = pengajuan_surat::where('id_surat', $request->id_surat)
                                ->where('id', Auth::id())
                                ->where('status', '<>', 'Selesai')
                                ->exists();

        if ($cek) {
            return response()->json([
                'message' => 'Surat sebelumnya belum selesai',
            ], 400);
        } else {
            $data = pengajuan_surat::create([
                'uuid' => Str::uuid(),
                'status' => $request->status,
                'keterangan' => 'Diajukan',
                'id_surat' => $request->id_surat,
                'id' => Auth::id(),
            ]);

            return response()->json([
                'message' => 'Berhasil mengajukan surat',
                'data' => $data
            ], 200);
        }
    }
}
    public function suratmasuk(Request $request)
    {
        $rt = $request->input('rt'); // rt yang dipilih atau ditentukan
        $status = $request->input('status');
        $suratMasuk = pengajuan_surat::select('pengajuan_surats.*', 'master_akuns.id as id_akun', 'master_masyarakats.*')
        ->join('master_akuns', 'pengajuan_surats.id', '=', 'master_akuns.id')
        ->join('master_masyarakats', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
        ->where('pengajuan_surats.status', $status)
        ->whereHas('akun.masyarakat', function ($query) use ($rt) {
            $query->whereHas('kks', function ($query) use ($rt) {
                $query->where('rt', $rt);
            });
        })
        ->with('surat')
        ->get();

        return response()->json([
            'message' => 'success',
            'data' => $suratMasuk
        ], 200);
    }
    public function rekap(Request $request)
    {
        $rt = $request->input('rt'); // rt yang dipilih atau ditentukan
        $suratMasuk = pengajuan_surat::select('pengajuan_surats.*', 'master_akuns.id as id_akun', 'master_masyarakats.*')
        ->join('master_akuns', 'pengajuan_surats.id', '=', 'master_akuns.id')
        ->join('master_masyarakats', 'master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakat')
        ->whereHas('akun.masyarakat', function ($query) use ($rt) {
            $query->whereHas('kks', function ($query) use ($rt) {
                $query->where('rt', $rt);
            });
        })
        ->with('surat')
        ->get();

        return response()->json([
            'message' => 'success',
            'data' => $suratMasuk
        ], 200);
    }

}
