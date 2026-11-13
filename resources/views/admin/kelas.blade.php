@extends('layouts.admin')

@section('title', 'Manajemen Data Kelas | SIAKAD Panel')
@section('page_title', 'Manajemen Data Kelas')
@section('page_data', 'kelasPage()')
@section('escape_action', 'modal = false; sidebar = false')
@section('year_label')
Tahun Ajaran {{ $tahunAjaran ?? '-' }}
@endsection

@section('content')
        <main class="flex-1 px-4 py-8 sm:px-8">

            {{-- Judul halaman --}}
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">Daftar Rombongan Belajar</h1>
                <p class="mt-2 text-sm text-slate-500">Kelola data kelas dan penugasan wali kelas untuk MI Internasional dan SMK Nusantara.</p>
            </div>

            @if (session('success'))
                <p class="mt-4 text-sm text-emerald-700" role="status">{{ session('success') }}</p>
            @endif
            @if ($errors->any())
                <div class="mt-4 text-sm text-red-600" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- Bar pencarian & filter --}}
            <div class="mt-8 flex flex-col gap-3 rounded-xl bg-white p-4 shadow-sm ring-1 ring-slate-100 sm:flex-row sm:items-center">
                <div class="relative w-full sm:max-w-xs lg:max-w-[320px] lg:flex-1">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    </span>
                    <input type="text" placeholder="Cari nama kelas..."
                           class="block w-full rounded-lg border border-slate-200 bg-slate-50/50 py-2.5 pl-10 pr-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-brand focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand/20">
                </div>

                <div class="relative w-full sm:w-56">
                    <select class="block w-full appearance-none rounded-lg border border-slate-200 bg-slate-50/50 py-2.5 pl-3 pr-9 text-sm text-slate-700 transition focus:border-brand focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand/20">
                        <option value="">-- Semua Unit --</option>
                        @foreach(($units ?? []) as $unit)
                            <option value="{{ strtolower($unit->kode_unit ?? '') }}">{{ $unit->nama_unit ?? '-' }}</option>
                        @endforeach
                    </select>
                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                    </span>
                </div>

                <button type="button" @click="openCreate()"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand px-5 py-2.5 text-sm font-semibold text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2 sm:ml-auto">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Tambah Kelas Baru
                </button>
            </div>

            {{-- Tabel --}}
            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[760px] text-left">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/60 text-[11px] font-semibold uppercase tracking-wider text-slate-500">
                                <th class="py-4 pl-6 pr-4 lg:pl-[104px]">Nama Kelas</th>
                                <th class="px-4 py-4">Unit Pendidikan</th>
                                <th class="px-4 py-4">Wali Kelas</th>
                                <th class="px-4 py-4">Jumlah Siswa</th>
                                <th class="px-4 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-800">

                            @forelse(($kelas ?? []) as $kelasItem)
                                <tr class="transition hover:bg-slate-50/60">
                                    <td class="py-4 pl-6 pr-4 font-medium text-slate-900 lg:pl-[104px]">{{ $kelasItem->nama_kelas ?? '-' }}</td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex rounded border px-2.5 py-1 text-xs font-medium {{ ($kelasItem->unit_code ?? null) === 'MI' ? 'border-amber-200 bg-amber-50 text-brand' : (($kelasItem->unit_code ?? null) === 'SMK' ? 'border-blue-200 bg-blue-50 text-blue-700' : 'border-slate-200 bg-slate-50 text-slate-500') }}">{{ $kelasItem->unit_pendidikan ?? '-' }}</span>
                                    </td>
                                    <td class="px-4 py-4 text-slate-700">{{ $kelasItem->wali_kelas_nama ?? '-' }}</td>
                                    <td class="px-4 py-4 text-slate-700">{{ ($kelasItem->jumlah_siswa ?? '-') === '-' ? '-' : $kelasItem->jumlah_siswa . ' Siswa' }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center justify-center gap-2.5 text-xs">
                                                <button type="button"
                                                        data-id="{{ $kelasItem->id ?? '' }}"
                                                        data-nama-kelas="{{ $kelasItem->nama_kelas ?? '' }}"
                                                        data-unit="{{ strtolower($kelasItem->unit_code ?? '') }}"
                                                        data-wali-kelas-id="{{ $kelasItem->wali_kelas_id ?? '' }}"
                                                        @click="openEdit($event.currentTarget.dataset)"
                                                        class="font-medium text-amber-500 hover:text-amber-600">Edit</button>
                                            <span class="h-3 w-px bg-slate-300"></span>
                                            <form action="{{ route('admin.kelas.destroy', ['kela' => $kelasItem->id]) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Hapus kelas ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 hover:text-red-700">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-400">Belum ada data kelas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Footer tabel --}}
                <div class="flex flex-col gap-3 border-t border-slate-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-slate-500">Menampilkan {{ isset($kelas) && is_object($kelas) && method_exists($kelas, 'firstItem') ? ($kelas->firstItem() ?? 0) : 0 }}-{{ isset($kelas) && is_object($kelas) && method_exists($kelas, 'lastItem') ? ($kelas->lastItem() ?? 0) : 0 }} dari {{ isset($kelas) && is_object($kelas) && method_exists($kelas, 'total') ? $kelas->total() : 0 }} kelas</p>
                    <div class="flex items-center gap-2">
                        <a href="{{ isset($kelas) && is_object($kelas) && method_exists($kelas, 'previousPageUrl') ? ($kelas->previousPageUrl() ?? '#') : '#' }}" class="rounded-lg border border-slate-200 bg-white px-4 py-1.5 text-xs font-medium text-slate-600 transition hover:bg-slate-50">Prev</a>
                        <a href="{{ isset($kelas) && is_object($kelas) && method_exists($kelas, 'nextPageUrl') ? ($kelas->nextPageUrl() ?? '#') : '#' }}" class="rounded-lg border border-slate-200 bg-white px-4 py-1.5 text-xs font-bold text-slate-900 transition hover:bg-slate-50">Next</a>
                    </div>
                </div>
            </div>

            {{-- Bar info --}}
            <div class="mt-8 flex flex-col gap-2 rounded-lg border border-dashed border-slate-300 bg-white/60 px-4 py-3 text-[11px] text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-3.5 w-3.5 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
                    Data terintegrasi secara terpusat untuk Yayasan Nurun 'Alannur (MI Internasional &amp; SMK Nusantara).
                </p>
                <span class="text-slate-400">Sistem versi {{ $versi ?? '-' }}</span>
            </div>
        </main>
@endsection

@section('outside_content')
{{-- ===================== MODAL TAMBAH KELAS BARU ===================== --}}
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
        <div class="flex items-start justify-between border-b border-slate-100 px-6 py-5">
            <div>
                <h3 id="modal-title" class="flex items-center gap-2 text-lg font-medium text-slate-900">
                    <span class="h-2 w-2 rounded-full bg-brand"></span>
                    <span x-text="editing ? 'Edit Kelas' : 'Tambah Kelas Baru'">Tambah Kelas Baru</span>
                </h3>
                <p class="mt-1 text-xs text-slate-500">Lengkapi formulir untuk membuat rombongan belajar baru.</p>
            </div>
            <button type="button" @click="modal = false" aria-label="Tutup"
                    class="rounded-lg p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form x-bind:action="editing ? updateUrl.replace('__kela__', form.id) : storeUrl"
              method="POST" class="flex min-h-0 flex-1 flex-col">
            @csrf
            <template x-if="editing">
                @method('PUT')
            </template>
            <input type="hidden" name="edit_id" x-bind:value="form.id" x-bind:disabled="!editing">

            {{-- Body modal --}}
            <div class="flex-1 space-y-5 overflow-y-auto px-6 py-6">

                {{-- Unit Pendidikan --}}
                <div>
                    <label for="unit" class="mb-2 block text-xs font-medium uppercase tracking-wide text-slate-700">
                        Unit Pendidikan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="unit" name="unit" required x-model="form.unit"
                                class="block w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-3.5 pr-10 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                            <option value="">Pilih Unit Pendidikan...</option>
                            @foreach(($units ?? []) as $unit)
                                <option value="{{ strtolower($unit->kode_unit ?? '') }}">{{ $unit->nama_unit ?? '-' }}</option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                        </span>
                    </div>
                    @error('unit')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nama Kelas / Rombel --}}
                <div>
                    <label for="nama" class="mb-2 block text-xs font-medium uppercase tracking-wide text-slate-700">
                        Nama Kelas / Rombel <span class="text-red-500">*</span>
                    </label>
                    <input id="nama" name="nama_kelas" type="text" required x-model="form.nama_kelas"
                           placeholder="Contoh: X TKJ 1 atau Kelas 1 (Abu Bakar)"
                           class="block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                    <p class="mt-1.5 text-[11px] text-slate-500">Gunakan format standar penamaan rombel yang berlaku di yayasan.</p>
                    @error('nama_kelas')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Wali Kelas --}}
                <div>
                    <label for="wali" class="mb-2 block text-xs font-medium uppercase tracking-wide text-slate-700">
                        Wali Kelas Terdisposisi <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="wali" name="wali_kelas_id" required x-model="form.wali_kelas_id"
                                class="block w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-3.5 pr-10 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                            <option value="">Pilih Guru sebagai Wali Kelas...</option>
                            @foreach(($waliKelas ?? []) as $wali)
                                <option value="{{ $wali->id ?? '' }}">{{ $wali->name ?? '-' }}</option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                        </span>
                    </div>
                    @error('wali_kelas_id')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror

                    <div class="mt-3 flex items-start gap-2 rounded-lg border border-blue-100 bg-blue-50 px-3 py-2.5 text-xs leading-relaxed text-blue-700">
                        <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
                        <p>Wali kelas yang dipilih akan otomatis mendapatkan akses Panel Wali Kelas di portal Guru.</p>
                    </div>
                </div>
            </div>

            {{-- Footer modal --}}
            <div class="flex items-center justify-between gap-3 bg-slate-50 px-6 py-4">
                <p class="text-[11px] text-slate-500"><span class="text-red-500">*</span> Wajib diisi</p>
                <div class="flex items-center gap-2.5">
                    <button type="button" @click="modal = false"
                            class="rounded-lg border border-slate-200 bg-white px-5 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit"
                            class="inline-flex items-center gap-2 rounded-lg bg-brand px-5 py-2 text-sm font-semibold text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        <span x-text="editing ? 'Simpan Perubahan' : 'Simpan Kelas'"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('kelasPage', () => ({
        sidebar: false,
        modal: @js($errors->any()),
        editing: Boolean(@js(old('edit_id'))),
        storeUrl: @js(route('admin.kelas.store')),
        updateUrl: @js(route('admin.kelas.update', ['kela' => '__kela__'])),
        form: {
            id: @js(old('edit_id')),
            unit: @js(old('unit', '')),
            nama_kelas: @js(old('nama_kelas', '')),
            wali_kelas_id: @js(old('wali_kelas_id', '')),
        },

        openCreate() {
            this.editing = false;
            this.form = { id: null, unit: '', nama_kelas: '', wali_kelas_id: '' };
            this.modal = true;
        },

        openEdit(data) {
            this.editing = true;
            this.form = {
                id: data.id,
                unit: data.unit,
                nama_kelas: data.namaKelas,
                wali_kelas_id: data.waliKelasId,
            };
            this.modal = true;
        },
    }));
});
</script>
@endpush
