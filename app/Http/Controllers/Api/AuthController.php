<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * POST /api/v1/auth/login
     * Login untuk orang tua/anak. Return token Sanctum.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Support login via username atau email
        $user = User::where('username', $request->username)
            ->orWhere('email', $request->username)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Username atau password salah.',
            ], 401);
        }

        if (!$user->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Akun Anda tidak aktif. Hubungi admin.',
            ], 403);
        }

        // Ambil data anak
        $anak = $user->getAnakData();

        // Revoke token lama (single session) dan buat token baru
        $user->tokens()->delete();
        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'success' => true,
            'token'   => $token,
            'user'    => [
                'id'       => $user->id,
                'name'     => $user->name,
                'username' => $user->username,
                'email'    => $user->email,
                'roles'    => $user->getRoleNames(),
            ],
            'anak' => $anak ? [
                'id'             => $anak->id,
                'nama'           => $anak->nama,
                'foto'           => $anak->foto ? asset('storage/anak/' . $anak->foto) : null,
                'tanggal_lahir'  => $anak->tanggal_lahir,
                'usia'           => $anak->usia,
                'diagnosa'       => $anak->diagnosa,
                'status'         => $anak->status,
            ] : null,
        ]);
    }

    /**
     * POST /api/v1/auth/logout
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil logout.',
        ]);
    }

    /**
     * GET /api/v1/auth/me
     * Return data user yang sedang login + data anaknya.
     */
    public function me(Request $request)
    {
        $user = $request->user();
        $anak = $user->getAnakData();

        return response()->json([
            'success' => true,
            'user'    => [
                'id'       => $user->id,
                'name'     => $user->name,
                'username' => $user->username,
                'email'    => $user->email,
                'roles'    => $user->getRoleNames(),
            ],
            'anak' => $anak ? [
                'id'            => $anak->id,
                'nama'          => $anak->nama,
                'foto'          => $anak->foto ? asset('storage/anak/' . $anak->foto) : null,
                'tanggal_lahir' => $anak->tanggal_lahir,
                'usia'          => $anak->usia,
                'diagnosa'      => $anak->diagnosa,
                'alamat'        => $anak->alamat,
                'nama_ayah'     => $anak->nama_ayah,
                'nama_ibu'      => $anak->nama_ibu,
                'status'        => $anak->status,
            ] : null,
        ]);
    }
}
