<?php

namespace App\Http\Controllers;

use App\Helpers\LogAktivitasHelper;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\TahunAjaran;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function page()
    {
        $staffRoles = ['guru', 'wali_kelas', 'pihak_yayasan'];
        $roleLabels = [
            'guru' => 'Guru',
            'wali_kelas' => 'Wali Kelas',
            'pihak_yayasan' => 'Pihak Yayasan',
        ];
        $activeYear = TahunAjaran::query()->where('is_active', true)->first();
        $tahunAjaran = $activeYear
            ? "{$activeYear->year} {$activeYear->semester}"
            : '-';
        $units = Unit::query()
            ->whereIn('kode_unit', ['MI', 'SMK', 'TU_PUSA'])
            ->orderBy('nama_unit')
            ->get();
        $roles = User::query()
            ->whereIn('role', $staffRoles)
            ->select('role')
            ->distinct()
            ->orderBy('role')
            ->pluck('role')
            ->map(fn ($role) => $roleLabels[$role] ?? '-')
            ->values();
        $users = User::query()
            ->whereIn('role', $staffRoles)
            ->with('kelasWali')
            ->latest()
            ->paginate(4);
        $userRows = $users->getCollection()->map(function (User $user) use ($roleLabels, $units) {
            $tingkat = mb_strtoupper(trim((string) ($user->kelasWali?->tingkat ?? '')));
            $unitCode = in_array($tingkat, ['X', 'XI', 'XII'], true)
                ? 'SMK'
                : (preg_match('/^[1-6]$/', $tingkat) ? 'MI' : null);
            $unit = $units->firstWhere('kode_unit', $unitCode);

            return [
                'id' => $user->id,
                'nama' => $user->name,
                'nip' => '-',
                'peran' => $roleLabels[$user->role] ?? '-',
                'unit' => $unit?->nama_unit ?? '-',
                'status' => '-',
            ];
        })->values();

        return view('admin.pengguna', compact('tahunAjaran', 'units', 'roles', 'users', 'userRows'));
    }

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
