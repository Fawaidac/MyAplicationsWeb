<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\master_akun;
use App\Models\master_kks;
use App\Models\master_masyarakat;
use Illuminate\Support\Facades\Validator;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
    $request->validate([
        'no_hp' => 'required|string',
        'nik' => 'required|string|min:16',
        'password' => 'required|min:8',
    ]);

    
    $dataMasyarakat = master_masyarakat::where('nik', $request->nik)->first();
    if (!$dataMasyarakat) {
        return response()->json([
            'message' => 'Nik anda belum terdaftar',
        ], 400);
    }
    if (master_akun::where('id_masyarakat', $dataMasyarakat->id_masyarakat)->exists()) {
    return response()->json([
        'message' => 'Akun sudah terdaftar',
    ], 400);
    }

    $data = master_akun::create([
        'id_masyarakat' => $dataMasyarakat->id_masyarakat,
        'role' => '4',
        'no_hp' => $request->no_hp,
        'password' => Hash::make($request->password),
    ]);

    $response = [
        'message' => 'Berhasil Register',
        'user' => $data,
    ];

    return response()->json($response, 200);
}

public function login(Request $request) {
    $request->validate([
        'nik' => 'required|string|min:16',
        'password' => 'required|string|min:8',
    ]);

    $dataMasyarakat = master_masyarakat::where('nik', $request->nik)->first();
    if (!$dataMasyarakat) {
        return response()->json([
            'message' => 'Nik Anda Belum Terdaftar',
        ], 400);
    }

    $akun = master_akun::where('id_masyarakat', $dataMasyarakat->id_masyarakat)->first();
    if (!Hash::check($request->password, $akun->password)) {
        return response()->json([
            'message' => 'Password Anda Salah',
        ], 400);
    }
    $token = $akun->createToken('authToken')->plainTextToken;
    $response = [
        'message' => 'Berhasil login',
        'user' => $dataMasyarakat,
        'token' => $token,
        'role' => $akun->role,
    ];

    return response()->json($response, 200);
}
    public function me()
{
    $user = Auth::user();

    $response = [
        'message' => 'success',
        'data' => $user->load(['masyarakat', 'masyarakat.kks'])
    ];

    return response()->json($response, 200);
}
public function logout(){
        $logout = auth()->user()->currentAccessToken()->delete();
        $response = [
        'message' => 'success',
    ];

    return response()->json($response, 200);
}
public function keluarga(Request $request)
{
    $user = $request->user();
    $id_masyarakat = $user->id_masyarakat;

    // Ambil nomor kartu keluarga dari user
    $no_kk = master_kks::whereHas('masyarakat', function ($query) use ($id_masyarakat) {
            $query->where('id_masyarakat', $id_masyarakat);
        })->value('no_kk');

    // Ambil data keluarga dari nomor kartu keluarga
    $keluarga = master_kks::with('masyarakat')->where('no_kk', $no_kk)->first();
    
    $response = [
        'message' => 'success',
        'data' => $keluarga
    ];
    return response()->json($response);
}
public function editnohp(Request $request){
    $user = $request->user();
    $no_hp = $user->no_hp;

    // Validate the incoming request
    $validator = Validator::make($request->all(), [
        'no_hp' => [
            'required',
            'min:10',
            'unique:master_akuns,no_hp,'.$user->id,
            function ($attribute, $value, $fail) use ($no_hp) {
                if ($value === $no_hp) {
                    $fail('Nomor HP baru harus berbeda dengan nomor HP lama');
                }
            },
        ],
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => $validator->errors()->first(),
        ], 400);
    }

    // Update the user's no_hp
    $user->update([
        'no_hp' => $request->no_hp,
    ]);

    return response()->json([
        'message' => 'Nomor HP berhasil diperbarui',
    ], 200);
}

}
