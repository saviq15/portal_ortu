@extends('layouts.admin')

@section('title', 'Manajemen Data Pengguna | SIAKAD Panel')
@section('page_title', 'Manajemen Data Pengguna')
@section('page_data', 'penggunaPage()')
@section('escape_action', 'modal = false; sidebar = false')
@section('year_label')
Tahun Ajaran {{ $tahunAjaran }}
@endsection

@section('content')
        <main class="flex-1 px-4 py-8 sm:px-8">

            {{-- Judul halaman --}}
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">Direktori Pendidik &amp; Tenaga Kependidikan</h1>
                <p class="mt-2 text-sm text-slate-500">Kelola akun akses, peran, dan penugasan staf untuk MI Internasional dan SMK Nusantara.</p>
            </div>

            {{-- Bar pencarian & filter --}}
            <div class="mt-8 flex flex-col gap-3 rounded-xl bg-white p-4 shadow-sm ring-1 ring-slate-100 sm:flex-row sm:items-center">
                <div class="relative w-full sm:max-w-xs lg:max-w-[320px] lg:flex-1">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    </span>
                    <input type="text" x-model="search" placeholder="Cari nama atau NIP..."
                           class="block w-full rounded-lg border border-slate-200 bg-slate-50/50 py-2.5 pl-10 pr-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-brand focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand/20">
                </div>

                <div class="relative w-full sm:w-56">
                    <select x-model="filterPeran"
                            class="block w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-3 pr-9 text-sm text-slate-700 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                        <option value="">-- Semua Peran --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                    </span>
                </div>

                <button type="button" @click="modal = true"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand px-5 py-2.5 text-sm font-semibold text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2 sm:ml-auto">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Tambah Pengguna
                </button>
            </div>

            {{-- Tabel --}}
            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[860px] text-left">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/60 text-[11px] font-semibold uppercase tracking-wider text-slate-500">
                                <th class="py-4 pl-6 pr-4 lg:pl-[88px]">Nama Lengkap &amp; NIP</th>
                                <th class="px-4 py-4">Peran Sistem</th>
                                <th class="px-4 py-4">Unit Tugas</th>
                                <th class="px-4 py-4">Status Akun</th>
                                <th class="px-4 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-800">

                            <template x-for="u in filtered" :key="u.id">
                                <tr class="transition hover:bg-slate-50/60">
                                    <td class="py-4 pl-6 pr-4 lg:pl-[88px]">
                                        <p class="font-medium text-slate-900" x-text="u.nama"></p>
                                        <p class="mt-1 text-xs text-slate-400" x-text="u.nip"></p>
                                    </td>
                                    <td class="px-4 py-4 text-slate-700" x-text="u.peran"></td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex rounded border px-2.5 py-1 text-xs font-medium"
                                              :class="unitClass(u.unit)" x-text="u.unit"></span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-0.5 text-xs font-semibold"
                                              :class="u.status === 'Aktif' ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : 'border-slate-200 bg-slate-100 text-slate-600'">
                                            <span class="h-1.5 w-1.5 rounded-full"
                                                  :class="u.status === 'Aktif' ? 'bg-emerald-500' : 'bg-slate-400'"></span>
                                            <span x-text="u.status"></span>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center justify-center gap-3 text-xs">
                                            <button type="button" class="font-medium text-amber-500 hover:text-amber-600">Edit</button>
                                            <span class="h-3 w-px bg-slate-300"></span>
                                            <button type="button" @click="toggleStatus(u)"
                                                    class="font-medium"
                                                    :class="u.status === 'Aktif' ? 'text-red-600 hover:text-red-700' : 'text-emerald-600 hover:text-emerald-700'"
                                                    x-text="u.status === 'Aktif' ? 'Nonaktifkan' : 'Aktifkan'"></button>
                                        </div>
                                    </td>
                                </tr>
                            </template>

                            <tr x-cloak x-show="filtered.length === 0">
                                <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-400">Data pengguna tidak ditemukan.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Footer tabel --}}
                <div class="flex flex-col gap-3 border-t border-slate-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-slate-500">Menampilkan {{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} pengguna</p>
                    <div class="flex items-center gap-2">
                        <a href="{{ $users->previousPageUrl() ?? '#' }}" class="rounded-lg border border-slate-200 bg-white px-4 py-1.5 text-sm text-slate-500 transition hover:bg-slate-50">Prev</a>
                        <a href="{{ $users->nextPageUrl() ?? '#' }}" class="rounded-lg border border-slate-200 bg-white px-4 py-1.5 text-sm text-slate-800 transition hover:bg-slate-50">Next</a>
                    </div>
                </div>
            </div>

            {{-- Bar info --}}
            <div class="mt-8 flex flex-col gap-2 rounded-lg border border-slate-200 bg-white px-4 py-3.5 text-[11px] text-slate-500 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-3.5 w-3.5 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
                    Data terintegrasi secara terpusat untuk Yayasan Nurun 'Alannur (MI Internasional &amp; SMK Nusantara).
                </p>
                <span class="text-slate-400">Sistem versi 2.4.0</span>
            </div>
        </main>
@endsection

@section('outside_content')
{{-- ===================== MODAL TAMBAH PENGGUNA BARU ===================== --}}
<div x-cloak x-show="modal" class="fixed inset-0 z-50 flex items-center justify-center p-4"
     role="dialog" aria-modal="true" aria-labelledby="modal-title">

    {{-- Backdrop blur --}}
    <div x-show="modal" x-transition.opacity @click="modal = false"
         class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

    {{-- Panel --}}
    <div x-show="modal"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="relative flex max-h-[95vh] w-full max-w-lg flex-col overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-slate-100">

        {{-- Header modal --}}
        <div class="flex items-start justify-between border-b border-slate-200 px-6 py-4">
            <div>
                <h3 id="modal-title" class="text-lg font-semibold text-slate-900">Tambah Pengguna Baru</h3>
                <p class="mt-0.5 text-xs text-slate-500">Lengkapi formulir untuk mendaftarkan akun staf atau pendidik baru.</p>
            </div>
            <button type="button" @click="modal = false" aria-label="Tutup"
                    class="rounded-lg p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="{{ route('admin.pengguna.index') }}" method="POST" @submit.prevent="tambah()" class="flex min-h-0 flex-1 flex-col">
            @csrf

            {{-- Body modal --}}
            <div class="flex-1 space-y-4 overflow-y-auto px-6 py-5">

                {{-- Nama Lengkap & Gelar --}}
                <div>
                    <label for="nama" class="mb-1.5 block text-xs font-medium uppercase tracking-wide text-slate-700">
                        Nama Lengkap &amp; Gelar <span class="text-red-500">*</span>
                    </label>
                    <input id="nama" name="nama" type="text" required x-model="form.nama"
                           placeholder="Contoh: Ustadzah Fatimah, S.Pd"
                           class="block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                </div>

                {{-- NIP / NIK --}}
                <div>
                    <label for="nip" class="mb-1.5 block text-xs font-medium uppercase tracking-wide text-slate-700">
                        Nomor Induk Pegawai (NIP/NIK) <span class="text-red-500">*</span>
                    </label>
                    <input id="nip" name="nip" type="text" required inputmode="numeric" x-model="form.nip"
                           placeholder="Masukkan 16 digit NIP..."
                           class="block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                    <p class="mt-1 text-[11px] text-slate-400">Gunakan format angka tanpa spasi atau karakter tanda baca.</p>
                </div>

                {{-- Unit & Peran (2 kolom) --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="unit" class="mb-1.5 block text-xs font-medium uppercase tracking-wide text-slate-700">
                            Unit Penugasan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="unit" name="unit" required x-model="form.unit"
                                    class="block w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-3.5 pr-10 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                                <option value="">Pilih Unit...</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->nama_unit }}">{{ $unit->nama_unit }}</option>
                                @endforeach
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                            </span>
                        </div>
                    </div>

                    <div>
                        <label for="peran" class="mb-1.5 block text-xs font-medium uppercase tracking-wide text-slate-700">
                            Peran Sistem <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="peran" name="peran" required x-model="form.peran"
                                    class="block w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-3.5 pr-10 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                                <option value="">Pilih Peran...</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer modal --}}
            <div class="flex items-center justify-end gap-2.5 border-t border-slate-200 bg-white px-6 py-4">
                <button type="button" @click="modal = false"
                        class="rounded-lg border border-slate-200 bg-white px-5 py-2 text-sm font-medium text-slate-800 transition hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-brand px-5 py-2 text-sm font-semibold text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
        Alpine.data('penggunaPage', () => ({
            sidebar: false,
            modal: false,
            search: '',
            filterPeran: '',
            form: { nama: '', nip: '', unit: '', peran: '' },

            users: @js($userRows),

            get filtered() {
                const q = this.search.toLowerCase().trim();
                return this.users.filter(u =>
                    (!q || u.nama.toLowerCase().includes(q) || u.nip.includes(q)) &&
                    (!this.filterPeran || u.peran === this.filterPeran)
                );
            },

            unitClass(unit) {
                if (unit === 'Madrasah Ibtidaiyah') return 'border-amber-200 bg-amber-50 text-brand';
                if (unit === 'SMK Yayasan') return 'border-blue-200 bg-blue-50 text-blue-700';
                return 'border-purple-200 bg-purple-50 text-purple-700';
            },

            toggleStatus(u) {
                u.status = u.status === 'Aktif' ? 'Nonaktif' : 'Aktif';
            },

            tambah() {
                this.users.unshift({ ...this.form, status: 'Aktif' });
                this.form = { nama: '', nip: '', unit: '', peran: '' };
                this.modal = false;
            },
        }));
    });
</script>
@endpush
