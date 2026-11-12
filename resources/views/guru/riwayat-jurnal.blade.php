@extends('layouts.guru')

@section('title', 'Jurnal & Penilaian Kelas | SIAKAD Panel')
@section('page_title', 'Jurnal &amp; Penilaian Kelas')
@section('page_data', 'jurnalPage()')

@section('content')
        <main class="flex-1 px-4 py-8 sm:px-8">
            {{--  route('jurnal.store') --}}
            <form action="#" method="POST" @submit.prevent="simpan()">
                @csrf

                {{-- Tautan kembali + judul --}}
                <a href="#" class="inline-flex items-center gap-1.5 text-sm text-slate-500 transition hover:text-slate-800">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                    Kembali ke Riwayat Jurnal
                </a>

                <div class="mt-3 flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <h1 class="text-2xl tracking-tight text-slate-800">Input Jurnal &amp; Evaluasi Harian</h1>
                        <p class="mt-2 text-sm text-slate-500">Atur jadwal KBM, isi materi, dan berikan catatan capaian siswa.</p>
                    </div>
                    <span class="inline-flex w-fit items-center gap-2 rounded-md border border-sky-200 bg-sky-50 px-3 py-1.5 text-xs text-sky-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Terhubung Langsung ke Buku Log Wali Murid
                    </span>
                </div>

                {{-- ============ 1. PILIH SESI PEMBELAJARAN ============ --}}
                <section class="mt-6 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="flex items-center gap-2.5 text-sm uppercase tracking-wide text-slate-800">
                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-slate-800 text-xs text-white">1</span>
                            Pilih Sesi Pembelajaran
                        </h3>
                        <span class="inline-flex w-fit items-center gap-1.5 rounded-md border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs text-emerald-700">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                            <span x-text="'Menampilkan ' + siswa.length + ' Siswa dari Kelas ' + kelas"></span>
                        </span>
                    </div>

                    <div class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-3">
                        {{-- Tanggal --}}
                        <div>
                            <label for="tanggal" class="mb-2 block text-[11px] uppercase tracking-wider text-slate-500">Tanggal *</label>
                            <input id="tanggal" name="tanggal" type="date" x-model="tanggal" required
                                   class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                        </div>

                        {{-- Kelas --}}
                        <div>
                            <label for="kelas" class="mb-2 block text-[11px] uppercase tracking-wider text-slate-500">Pilih Kelas *</label>
                            <div class="relative">
                                <select id="kelas" name="kelas" x-model="kelas" required
                                        class="block w-full appearance-none rounded-lg border border-slate-300 bg-white py-3 pl-4 pr-10 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                                    <template x-for="k in daftarKelas" :key="k"><option :value="k" x-text="k"></option></template>
                                </select>
                                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                                </span>
                            </div>
                        </div>

                        {{-- Mata pelajaran --}}
                        <div>
                            <label for="mapel" class="mb-2 block text-[11px] uppercase tracking-wider text-slate-500">Mata Pelajaran *</label>
                            <div class="relative">
                                <select id="mapel" name="mapel" x-model="mapel" required
                                        class="block w-full appearance-none rounded-lg border border-slate-300 bg-white py-3 pl-4 pr-10 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                                    <template x-for="m in daftarMapel" :key="m"><option :value="m" x-text="m"></option></template>
                                </select>
                                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ============ 2. MATERI PEMBELAJARAN ============ --}}
                <section class="mt-6 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <h3 class="flex items-center gap-2.5 text-sm uppercase tracking-wide text-slate-800">
                        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-slate-800 text-xs text-white">2</span>
                        Materi Pembelajaran
                    </h3>

                    <div class="mt-5">
                        <label for="materi" class="mb-2 block text-xs text-slate-600">Materi Pokok / Kompetensi Dasar <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input id="materi" name="materi" type="text" x-model="materi" required
                                   placeholder="Contoh: Pengenalan Topologi Star & Ring"
                                   class="block w-full rounded-lg border border-slate-300 bg-white py-3 pl-4 pr-11 text-sm text-slate-800 placeholder-slate-400 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                            <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg>
                            </span>
                        </div>
                        <p class="mt-2 flex items-center gap-1.5 text-xs text-sky-600">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Terkoneksi langsung ke kolom 'MATERI POKOK' di Buku Log Wali Murid.
                        </p>
                    </div>
                </section>

                {{-- ============ 3. DATA KEHADIRAN & CAPAIAN INDIVIDU ============ --}}
                <section class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
                    <div class="flex flex-col gap-3 px-6 py-6 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="flex items-center gap-2.5 text-sm uppercase tracking-wide text-slate-800">
                                <span class="flex h-6 w-6 items-center justify-center rounded-full bg-slate-800 text-xs text-white">3</span>
                                Data Kehadiran &amp; Capaian Individu
                            </h3>
                            <p class="mt-1 pl-[34px] text-xs text-slate-500" x-text="ringkasan"></p>
                        </div>
                        <button type="button" @click="setSemua()"
                                class="inline-flex w-fit items-center gap-2 rounded-md bg-brand px-4 py-2 text-xs text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                            Set Semua Hadir &amp; Tuntas
                        </button>
                    </div>

                    {{-- Tips efisiensi --}}
                    <div class="flex flex-col gap-1 border-y border-amber-100 bg-amber-50 px-6 py-2.5 text-xs text-amber-900 sm:flex-row sm:items-center sm:justify-between">
                        <p class="flex flex-wrap items-center gap-1.5">
                            <svg class="h-4 w-4 shrink-0 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                            Tips Efisiensi: Tekan tombol
                            <kbd class="rounded border border-amber-300 bg-white px-1.5 py-px text-[10px] text-amber-800">Tab</kbd>
                            untuk berpindah antar kolom input secara instan layaknya spreadsheet.
                        </p>
                        <p class="text-[11px] text-amber-700" x-text="'Terakhir disimpan otomatis: ' + terakhir"></p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[960px] text-left">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50/70 text-[11px] uppercase tracking-wider text-slate-500">
                                    <th class="w-16 py-4 pl-6 pr-2 font-normal">No</th>
                                    <th class="px-4 py-4 font-normal">Nama Siswa</th>
                                    <th class="px-2 py-4 font-normal">Presensi</th>
                                    <th class="px-2 py-4 font-normal">Status Capaian</th>
                                    <th class="px-2 py-4 font-normal">Nilai</th>
                                    <th class="py-4 pl-2 pr-6 font-normal">Catatan Harian Guru</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm text-slate-800">

                                <template x-for="(s, i) in siswa" :key="s.nis">
                                    <tr :class="s.presensi !== 'Hadir' ? 'bg-slate-50/80' : 'hover:bg-slate-50/40'" class="transition">
                                        <td class="py-3.5 pl-6 pr-2 text-slate-500" x-text="i + 1"></td>

                                        {{-- Nama --}}
                                        <td class="px-4 py-3.5">
                                            <div class="flex items-center gap-3">
                                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full text-xs font-medium"
                                                      :class="warnaAvatar(i)" x-text="inisial(s.nama)"></span>
                                                <div>
                                                    <p class="text-slate-900" x-text="s.nama"></p>
                                                    <p class="mt-0.5 text-[11px] text-slate-400" x-text="'NIS: ' + s.nis"></p>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Presensi --}}
                                        <td class="px-2 py-3.5">
                                            <div class="relative w-32">
                                                <span class="pointer-events-none absolute left-3 top-1/2 h-1.5 w-1.5 -translate-y-1/2 rounded-full"
                                                      :class="presensiWarna(s.presensi).dot"></span>
                                                <select x-model="s.presensi" @change="ubahPresensi(s)" :name="'siswa[' + s.nis + '][presensi]'"
                                                        class="block w-full appearance-none rounded-lg border py-2 pl-7 pr-6 text-xs transition focus:outline-none focus:ring-2"
                                                        :class="presensiWarna(s.presensi).select">
                                                    <option value="Hadir">Hadir</option>
                                                    <option value="Sakit">Sakit</option>
                                                    <option value="Izin">Izin</option>
                                                    <option value="Alpa">Alpa</option>
                                                </select>
                                            </div>
                                        </td>

                                        {{-- Status capaian --}}
                                        <td class="px-2 py-3.5">
                                            <div class="relative w-40">
                                                <select x-model="s.status" @change="tersimpan()" :disabled="s.presensi !== 'Hadir'"
                                                        :name="'siswa[' + s.nis + '][status]'"
                                                        class="block w-full appearance-none rounded-lg border py-2 pl-3 pr-6 text-xs transition focus:outline-none focus:ring-2 disabled:cursor-not-allowed"
                                                        :class="statusWarna(s.status)">
                                                    <option value="Belum Dinilai">Belum Dinilai</option>
                                                    <option value="Tuntas">Tuntas</option>
                                                    <option value="Perlu Bimbingan">Perlu Bimbingan</option>
                                                </select>
                                            </div>
                                        </td>

                                        {{-- Nilai --}}
                                        <td class="px-2 py-3.5">
                                            <input type="number" min="0" max="100" x-model="s.nilai" @input="ubahNilai(s)"
                                                   :disabled="s.presensi !== 'Hadir'" :name="'siswa[' + s.nis + '][nilai]'"
                                                   placeholder="-"
                                                   class="w-16 rounded-lg border border-slate-200 bg-white py-2 text-center text-xs text-slate-800 shadow-sm transition [appearance:textfield] placeholder-slate-400 focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 disabled:cursor-not-allowed disabled:bg-slate-100 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                                        </td>

                                        {{-- Catatan --}}
                                        <td class="py-3.5 pl-2 pr-6">
                                            <input type="text" x-model="s.catatan" @input="tersimpan()"
                                                   :disabled="s.presensi !== 'Hadir'" :name="'siswa[' + s.nis + '][catatan]'"
                                                   :placeholder="s.presensi !== 'Hadir' ? '-' : 'Tambahkan catatan...'"
                                                   class="block w-full min-w-[260px] rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-xs text-slate-800 shadow-sm transition placeholder-slate-400 focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 disabled:cursor-not-allowed disabled:bg-slate-100">
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>

                    {{-- Aksi simpan --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50/60 px-6 py-4 sm:flex-row sm:items-center sm:justify-end">
                        <button type="button"
                                class="rounded-lg border border-slate-200 bg-white px-5 py-2 text-sm text-slate-700 transition hover:bg-slate-50">
                            Batal
                        </button>
                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand px-5 py-2 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                            Simpan Jurnal
                        </button>
                    </div>
                </section>
            </form>

            {{-- Info bar --}}
            <div class="mt-6 flex flex-col gap-2 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    Jurnal dan Penilaian terintegrasi secara otomatis ke Rapor Digital Siswa.
                </p>
                <span>SIAKAD v2.4.0</span>
            </div>
        </main>
@endsection

@section('outside_content')
{{-- Notifikasi simpan (simulasi) --}}
<div x-cloak x-show="toast" x-transition
     class="fixed bottom-6 right-6 z-50 flex items-center gap-2.5 rounded-lg bg-slate-900 px-4 py-3 text-sm text-white shadow-xl">
    <svg class="h-4 w-4 text-emerald-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
    <span x-text="'Jurnal ' + mapel + ' - ' + kelas + ' berhasil disimpan.'"></span>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
        Alpine.data('jurnalPage', () => ({
            sidebar: false,
            toast: false,
            toastTimer: null,
            terakhir: '1 menit lalu',
            kkm: 75, // batas ketuntasan minimal

            tanggal: '2026-10-26',
            kelas: 'X TKJ 1',
            mapel: 'Dasar Jaringan',
            materi: 'Pengenalan Topologi Star & Ring',
            daftarKelas: ['X TKJ 1', 'X TKJ 2', 'XI TKR 1', 'XI TKR 2'],
            daftarMapel: ['Dasar Jaringan', 'Mesin Otomotif', 'Pendidikan Agama Islam'],

            // Data dummy 34 siswa (frontend saja)
            siswa: (() => {
                const awal = [
                    { nis: '20261001', nama: 'Ahmad Fauzi',    presensi: 'Hadir', status: 'Tuntas',          nilai: 85, catatan: 'Mampu mempraktikkan crimping kabel dengan sangat baik.' },
                    { nis: '20261002', nama: 'Budi Santoso',   presensi: 'Alpa',  status: 'Belum Dinilai',   nilai: '', catatan: '' },
                    { nis: '20261003', nama: 'Citra Lestari',  presensi: 'Hadir', status: 'Perlu Bimbingan', nilai: 60, catatan: 'Masih bingung urutan kabel.' },
                    { nis: '20261004', nama: 'Dedi Kurniawan', presensi: 'Hadir', status: 'Tuntas',          nilai: 80, catatan: 'Aktif bertanya dan cepat memahami skema topologi bus & star.' },
                ];
                const lainnya = [
                    'Eko Prasetyo', 'Fajar Nugroho', 'Galih Pratama', 'Hafidz Maulana', 'Imam Syafii',
                    'Indra Kusuma', 'Khoirul Anam', 'Lutfi Hakim', 'Miftahul Huda', 'Nanda Saputra',
                    'Oki Setiawan', 'Putri Maharani', 'Qori Aulia', 'Rian Hidayat', 'Siti Nurhaliza',
                    'Taufik Hidayat', 'Umar Faruq', 'Vina Anggraini', 'Wahyu Setiawan', 'Yusuf Ramadhan',
                    'Zahra Salsabila', 'Alfin Maulidi', 'Bagus Setiaji', 'Candra Wijaya', 'Dwi Lestari',
                    'Elisa Putri', 'Farhan Alfarizi', 'Gita Permata', 'Hanif Abdillah', 'Ilham Ramadhani',
                ].map((nama, i) => ({
                    nis: String(20261005 + i),
                    nama,
                    presensi: nama === 'Rian Hidayat' ? 'Alpa' : 'Hadir',
                    status: 'Belum Dinilai', nilai: '', catatan: '',
                }));
                return [...awal, ...lainnya];
            })(),

            get ringkasan() {
                const hitung = (p) => this.siswa.filter(s => s.presensi === p).length;
                let teks = `Total terdaftar: ${this.siswa.length} Siswa (${hitung('Hadir')} Hadir, ${hitung('Alpa')} Alpa`;
                if (hitung('Sakit')) teks += `, ${hitung('Sakit')} Sakit`;
                if (hitung('Izin'))  teks += `, ${hitung('Izin')} Izin`;
                return teks + ')';
            },

            inisial(nama) {
                return nama.split(' ').slice(0, 2).map(k => k[0]).join('').toUpperCase();
            },

            warnaAvatar(i) {
                const palet = [
                    'bg-emerald-100 text-emerald-700', 'bg-rose-100 text-rose-600',
                    'bg-amber-100 text-amber-700',     'bg-sky-100 text-sky-700',
                    'bg-violet-100 text-violet-700',   'bg-teal-100 text-teal-700',
                ];
                return palet[i % palet.length];
            },

            presensiWarna(p) {
                const map = {
                    Hadir: { select: 'border-emerald-300 bg-white text-emerald-700 focus:ring-emerald-200', dot: 'bg-emerald-500' },
                    Sakit: { select: 'border-amber-300 bg-amber-50 text-amber-700 focus:ring-amber-200',    dot: 'bg-amber-500' },
                    Izin:  { select: 'border-sky-300 bg-sky-50 text-sky-700 focus:ring-sky-200',            dot: 'bg-sky-500' },
                    Alpa:  { select: 'border-red-300 bg-white text-red-600 focus:ring-red-200',             dot: 'bg-red-500' },
                };
                return map[p] || map.Hadir;
            },

            statusWarna(st) {
                if (st === 'Tuntas')          return 'border-emerald-300 bg-white text-emerald-700 focus:ring-emerald-200';
                if (st === 'Perlu Bimbingan') return 'border-amber-300 bg-white text-amber-700 focus:ring-amber-200';
                return 'border-slate-200 bg-slate-100 text-slate-400 focus:ring-slate-200';
            },

            // Jika tidak hadir, status/nilai/catatan dikosongkan dan dikunci
            ubahPresensi(s) {
                if (s.presensi !== 'Hadir') {
                    s.status = 'Belum Dinilai';
                    s.nilai = '';
                    s.catatan = '';
                }
                this.tersimpan();
            },

            // Nilai dibatasi 0-100, status otomatis mengikuti nilai
            ubahNilai(s) {
                if (s.nilai !== '' && s.nilai !== null) {
                    const v = parseInt(s.nilai, 10);
                    s.nilai = isNaN(v) ? '' : Math.min(100, Math.max(0, v));
                    if (s.nilai !== '') s.status = s.nilai >= this.kkm ? 'Tuntas' : 'Perlu Bimbingan';
                }
                this.tersimpan();
            },

            setSemua() {
                this.siswa.forEach(s => { s.presensi = 'Hadir'; s.status = 'Tuntas'; });
                this.tersimpan();
            },

            // Simulasi simpan otomatis
            tersimpan() {
                this.terakhir = 'baru saja';
            },

            simpan() {
                this.toast = true;
                this.tersimpan();
                clearTimeout(this.toastTimer);
                this.toastTimer = setTimeout(() => this.toast = false, 3000);
            },
        }));
    });
</script>
@endpush
