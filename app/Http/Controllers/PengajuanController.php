<?php

namespace App\Http\Controllers;

use App\Models\master_masyarakat;
use App\Models\pengajuan_surat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function pengajuan(Request $request){
    $request->validate([
        'status' => 'required',
        'keterangan' => 'required',
        'id_surat' => 'required',
    ]);

    $existingSurat = pengajuan_surat::where('id_surat', $request->id_surat)
                                    ->where('id', $request->user()->id)
                                    ->first();  

    if (!$existingSurat) {
        $data = pengajuan_surat::create([
            'uuid' => Str::uuid(),
            'status' => 'Diajukan',
            'keterangan' => $request->keterangan,
            'id_surat' => $request->id_surat,
            'id' => $request->user()->id,
        ]);

        return response()->json([
            'message' => 'Berhasil mengajukan surat',
            'data' => $data
        ], 200);
    } else {
        $cek = pengajuan_surat::where('id_surat', $request->id_surat)
                                ->where('id', $request->user()->id)
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
                'id' => $request->user()->id,
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

    public function statussurat(Request $request){
        $no_kk = $request->input('no_kk');
        $status = $request->input('status');
        $statussurat = pengajuan_surat::select('pengajuan_surats.*','master_akuns.*', 'master_masyarakat.*')
        ->join('master_akuns','pengajuan_surats.id', '=', 'master_akuns.id')
        ->join('master_masyarakats','master_akuns.id_masyarakat', '=', 'master_masyarakats.id_masyarakats')
        ->where('pengajuan_surats.status', $status)
        ->whereHas('akun.masyarakat', function($query) use ($no_kk){
            $query->where('no_kk', $no_kk);
        })
        ->with('surat')
        ->get();

        return response()->json([
            'message' => 'success',
            'data' => $statussurat
        ], 200);
    }

}
