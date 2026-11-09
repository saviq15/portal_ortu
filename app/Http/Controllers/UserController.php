<?php

namespace App\Http\Controllers;

use App\Helpers\LogAktivitasHelper;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::with(['siswa', 'kelasWali'])->latest()->paginate(10));
    }

    public function store(Request $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        LogAktivitasHelper::catat('Menambahkan pengguna baru: ' . $user->name, 'Manajemen User', 'Username: ' . $user->username);

        return response()->json([
            'message' => 'Pengguna berhasil ditambahkan',
            'data' => new UserResource($user->load('siswa', 'kelasWali'))
        ], 201);
    }

    public function show(User $user)
    {
        return response()->json($user->load('siswa', 'kelasWali', 'logAktivitas'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        LogAktivitasHelper::catat('Memperbarui data pengguna: ' . $user->name, 'Manajemen User', 'ID: ' . $user->id);

        return response()->json([
            'message' => 'Pengguna berhasil diperbarui',
            'data' => new UserResource($user->load('siswa', 'kelasWali'))
        ]);
    }

    public function destroy(User $user)
    {
        $name = $user->name;
        $user->delete();

        LogAktivitasHelper::catat('Menghapus data pengguna: ' . $name, 'Manajemen User', 'ID: ' . $user->id);

        return response()->json([
            'message' => 'Pengguna berhasil dihapus'
        ]);
    }
}
