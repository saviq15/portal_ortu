# Kontrak Variabel View

## Konvensi

- Penamaan variabel menggunakan `camelCase`.
- Angka menggunakan tipe `int`.
- Tanggal menggunakan `Carbon` atau string berformat `Y-m-d`.
- Daftar menggunakan `Collection`, array, atau paginator jika halaman memiliki pagination.
- Nilai opsional ditangani dengan fallback `-`, `0`, koleksi kosong, atau opsi fallback yang mempertahankan tampilan sekarang.
- Tidak ada query database di view.

## Variabel Global Layout

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | View pemakai | Catatan |
|---|---|---|---|---|---|---|
| `$adminUser` | object/null | `name`, `role` | `{name: "Admin Yayasan", role: "admin"}` | dipakai | `layouts/admin.blade.php` | Diambil dari `Auth::user()` di layout; tidak perlu dikirim controller. |
| `$adminName` | string | nama untuk topbar dan sapaan Dashboard | `Admin Yayasan` | dipakai | Layout dan `admin/dashboard.blade.php` | Layout membaca dari `Auth::user()`. View Dashboard membaca `$adminName`; backend perlu membagikan nama yang sama ke view Dashboard. |
| `$adminInitials` | string | teks avatar topbar | `AY` | dipakai | `layouts/admin.blade.php` | Dihitung otomatis dari nama user login. |
| `$adminRole` | string | jabatan/peran topbar | `Super Administrator` | dipakai | `layouts/admin.blade.php` | Dihitung dari `Auth::user()->role`; role `admin` ditampilkan sebagai `Super Administrator`. |
| `$tahunAjaran` | string | badge tahun ajaran | `2026/2027 - Ganjil` | dipakai | Dashboard, Kelas, Pengguna, Tahun Ajaran | Nilai kosong menghasilkan badge `Tahun Ajaran -`. |
| `$versi` | string | teks versi sistem pada bar informasi | `2.4.0` | perlu konfirmasi backend | Dashboard, Kelas, Pengguna, Tahun Ajaran | Sebelumnya tertulis tetap di beberapa view; sumber nilai versi belum diketahui. Fallback `-`. |

## Dashboard

View: `admin/dashboard.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$totalUnit` | int | angka kartu Total Unit Sekolah | `2` | dipakai | Fallback `0`. |
| `$totalPendidikStaf` | int | angka kartu Total Pendidik & Staf | `6` | dipakai | Fallback `0`; perhitungan tetap menjadi tanggung jawab backend. |
| `$totalSiswa` | int | angka kartu Total Peserta Didik | `2` | dipakai | Fallback `0`. |
| `$siswaSmk` | int | rincian jumlah siswa SMK | `2` | dipakai | Fallback `0`. |
| `$siswaMi` | int | rincian jumlah siswa MI | `0` | dipakai | Fallback `0`. |
| `$statusSesi` | string | status di kartu sambutan | `Sesi Aktif` | perlu konfirmasi backend | Jika belum tersedia, view mempertahankan fallback `Sesi Aktif`. |

Kartu akses cepat, nama yayasan/unit pada copy deskriptif, ikon, dan label dipertahankan sebagai konten statis. Tiga tautan `Kelola` yang masih memakai `href="#"` dicatat pada bagian Form & Aksi.

## Data Kelas

View: `admin/kelas.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$units` | collection/array | `kode_unit`, `nama_unit` | `[{kode_unit: "MI", nama_unit: "MI Internasional"}]` | dipakai | Mengisi filter unit dan opsi modal. Opsi kosong bila variabel tidak dikirim. |
| `$kelas` | paginator/collection | `id`, `nama_kelas`, `unit_code`, `unit_pendidikan`, `wali_kelas_nama`, `jumlah_siswa`, `wali_kelas_id` | `[{id: 1, nama_kelas: "X TKJ 1", unit_code: "SMK", unit_pendidikan: "SMK Yayasan", wali_kelas_nama: "Nama Guru", jumlah_siswa: 24, wali_kelas_id: 3}]` | dipakai | Daftar menggunakan `@forelse`; field opsional memiliki fallback. Footer pagination menggunakan method paginator bila tersedia. |
| `$waliKelas` | collection/array | `id`, `name` | `[{id: 3, name: "Nama Guru"}]` | dipakai | Mengisi pilihan wali kelas pada modal. |

## Data Pengguna

View: `admin/pengguna.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$roles` | collection/array | string role | `["admin", "guru"]` | dipakai | Dipakai pada filter dan opsi modal. |
| `$units` | collection/array | `nama_unit` | `[{nama_unit: "MI Internasional"}]` | dipakai | Mengisi opsi unit pada modal. |
| `$users` | paginator/collection | `firstItem()`, `lastItem()`, `total()`, `previousPageUrl()`, `nextPageUrl()` | paginator pengguna | dipakai | Untuk ringkasan dan tombol pagination. Nilai footer aman jika paginator tidak dikirim. |
| `$userRows` | array/collection JSON-serializable | `id`, `nama`, `nip`, `peran`, `unit`, `status` | `[{id: 1, nama: "Nama Pendidik", nip: "1980000000000000", peran: "guru", unit: "SMK Yayasan", status: "Aktif"}]` | dipakai | Disematkan ke Alpine dengan `@json`; status yang dipakai logika tampilan adalah `Aktif` atau `Nonaktif`. `nama` dan `nip` perlu berupa string (gunakan `-` jika kosong) karena filter Alpine memanggil fungsi string. Daftar kosong jika tidak dikirim. |

## Tahun Ajaran

View: `admin/tahun-ajaran.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$periods` | paginator/collection | `firstItem()`, `lastItem()`, `total()`, `previousPageUrl()`, `nextPageUrl()` | paginator periode | dipakai | Untuk ringkasan dan tombol pagination. |
| `$periodRows` | array/collection JSON-serializable | `tahun`, `semester`, `status` | `[{tahun: "2026/2027", semester: "Ganjil", status: "Aktif"}]` | dipakai | Disematkan ke Alpine dengan `@json`; `tahun` dan `semester` perlu berupa string karena filter Alpine memanggil fungsi string. Daftar kosong jika tidak dikirim. Status aktif yang dikenali tampilan adalah `Aktif`. |
| `$periodStatuses` | array/collection | string status | `["Aktif", "-"]` | perlu konfirmasi backend | Mengisi pilihan filter status. Fallback mempertahankan opsi status yang saat ini tampil. |
| `$semesters` | array/collection | string semester | `["Ganjil", "Genap"]` | dipakai | Mengisi opsi semester modal; view menampilkan `Ganjil` dan `Genap` jika variabel tidak dikirim atau kosong. |

## Form & Aksi

Daftar berikut hanya mencatat keadaan tampilan saat ini. Tidak ada action, method, route, `@csrf`, atau logika JavaScript/Alpine form yang diubah pada tahap ini.

| Halaman | Form/tombol | Action atau handler saat ini | Kebutuhan route dari sisi tampilan | Catatan |
|---|---|---|---|---|
| Dashboard | Tiga tombol `Kelola` | `href="#"` | GET ke halaman modul terkait | Route tujuan belum jelas. |
| Kelas | Tambah/Edit kelas | Form menggunakan `storeUrl` atau `updateUrl`; `POST` dan `@method('PUT')` saat edit; `@csrf` | POST store dan PUT/PATCH update | Route dirakit di Alpine dari route yang sudah dipakai view. |
| Kelas | Hapus kelas | `admin.kelas.destroy`; form POST dengan `@method('DELETE')` dan `@csrf` | DELETE destroy | Sudah memiliki route/action pada view. |
| Pengguna | Tambah pengguna | `admin.pengguna.index`, `POST`, `@csrf`, `@submit.prevent="tambah()"` | POST store pengguna | Terlihat tersimpan di daftar lokal Alpine, tetapi submit dicegah sehingga tidak menyimpan ke server. |
| Pengguna | Edit | Tombol tanpa route/handler | PUT/PATCH update pengguna | Belum terhubung dari tampilan. |
| Pengguna | Aktifkan/Nonaktifkan | `toggleStatus(u)` hanya mengubah status di Alpine | PATCH perubahan status akun | Saat ini hanya perubahan lokal. |
| Tahun Ajaran | Tambah periode | `admin.tahun-ajaran`, `POST`, `@csrf`, `@submit.prevent="tambah()"` | POST store periode | Terlihat tersimpan di daftar lokal Alpine, tetapi submit dicegah sehingga tidak menyimpan ke server. |
| Tahun Ajaran | Edit | Tombol tanpa route/handler | PUT/PATCH update periode | Belum terhubung dari tampilan. |
| Tahun Ajaran | Kunci | `kunci(t)` mengubah status lokal | PATCH perubahan status periode | Saat ini hanya perubahan lokal; makna status akhir perlu dipastikan backend. |
| Tahun Ajaran | Detail | Tombol tanpa route/handler | GET detail periode | Belum terhubung dari tampilan. |
| Layout ADMIN | Keluar / Logout | Form POST ke `logout` dengan `@csrf` | Tidak ada perubahan | Form autentikasi/logout dipertahankan. |

## Portal GURU

### Variabel Global Layout

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | View pemakai | Catatan |
|---|---|---|---|---|---|---|
| `$guruUser` | object/null | `name`, `role` | `{name: "Heri Susanto", role: "guru"}` | dipakai | `layouts/guru.blade.php` | Diambil dari `Auth::user()` di layout; tidak perlu dikirim controller. |
| `$guruName` | string | nama guru untuk topbar dan isi halaman | `Heri Susanto` | dipakai | Layout, Dashboard, Jadwal Mengajar, Profil Pengguna | Layout membacanya dari user login. Isi halaman menggunakan nama yang sama; backend perlu membagikannya ke view. Sapaan “Bapak” tetap ditulis oleh view. |
| `$guruInitials` | string | inisial avatar | `HS` | dipakai | Layout, Profil Pengguna | Dihitung otomatis di layout; backend perlu membagikan nilai yang sama ke Profil Pengguna. |
| `$guruRoleLabel` | string | jabatan/peran di topbar | `Guru` | dipakai | `layouts/guru.blade.php` | Dihitung dari role user; role `wali_kelas` ditampilkan sebagai `Wali Kelas`. |
| `$guruNip` | string | NIP pada profil dan dokumen cetak | `198010202005011001` | perlu konfirmasi backend | Jadwal Mengajar, Profil Pengguna | Pastikan nilai NIP guru login dikirim sebagai string; fallback `-`. |
| `$tahunAjaran` | string | badge dan dokumen cetak | `2026/2027` | dipakai | Layout, Dashboard, Jadwal Mengajar | Tahun ajaran aktif; fallback `-`. |
| `$semester` | string | keterangan semester | `Ganjil` | dipakai | Dashboard, Jadwal Mengajar | Dipakai pada ringkasan Dashboard dan dokumen cetak. |
| `$bebanJam` | int | beban jam pelajaran per minggu | `24` | dipakai | Dashboard, Jadwal Mengajar | Angka yang sama dipakai di kartu dan ringkasan jadwal. |
| `$versi` | string | versi pada bar informasi | `2.4.0` | perlu konfirmasi backend | Semua halaman Guru | Sebelumnya tertulis tetap di view; sumber nilai versi belum diketahui. Fallback `-`. |
| `$namaYayasan` | string | nama yayasan | `Yayasan Nurun 'Alannur` | perlu konfirmasi backend | Dashboard, Jadwal Mengajar, Profil Pengguna | Data identitas yayasan pada teks informasi dan dokumen cetak. |

### Beranda Guru

View: `guru/dashboard.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$totalKelasDiajar` | int | angka kartu Total Kelas Diajar | `4` | dipakai | Fallback `0`. |
| `$ringkasanKelas` | string | ringkasan kelas dan sekolah | `Kelas X & XI SMK Nusantara` | perlu konfirmasi backend | View menampilkan teks ringkasan siap pakai; sumber dan format perlu dipastikan backend. |
| `$jurnalBelumDiisi` | int | angka kartu jurnal belum diisi dan kondisi badge | `2` | dipakai | Badge “Perlu Tindakan” dan gaya merah muncul hanya jika nilainya lebih dari `0`. |
| `$pesanJurnal` | string | pesan ringkas kartu jurnal | `Segera lengkapi nilai hari ini` | perlu konfirmasi backend | Fallback menampilkan pesan sesuai jumlah jurnal yang belum diisi. |
| `$namaHariIni` | string | nama hari pada judul jadwal hari ini | `Jumat` | dipakai | Backend menyediakan nama hari dalam bahasa Indonesia. |
| `$jadwalHariIni` | collection | `waktu`, `kelas`, `mapel`, `ruang`, `statusWaktu`, `bisaIsiJurnal`, `aksiUrl` | `[{waktu: "07:30 - 09:00", kelas: "X TKJ 1", mapel: "Dasar Jaringan", ruang: "Lab Komputer 1", statusWaktu: "berlangsung", bisaIsiJurnal: true, aksiUrl: "#"}]` | perlu konfirmasi backend | Daftar jadwal hari ini diurutkan menurut waktu. Backend menentukan status waktu dan kelayakan isi jurnal berdasarkan waktu sesi serta status jurnal. `aksiUrl` perlu rute yang disepakati; fallback `#`. |

### Jadwal Mengajar

View: `guru/jadwal-mengajar.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$hariOptions` | array/collection | string nama hari | `["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"]` | dipakai | Opsi “Semua Hari” tetap statis; ada fallback daftar hari yang saat ini tampil. |
| `$jadwalMengajar` | array/collection JSON-serializable | `hari`, `waktu`, `kelas`, `mapel`, `ruang`, `status` | `[{hari: "Senin", waktu: "07:30 - 09:00", kelas: "X TKJ 1", mapel: "Dasar Jaringan", ruang: "Lab Komputer 1", status: "Aktif"}]` | dipakai | Dipakai untuk tabel, filter, dan dokumen cetak. `waktu` berupa string terformat `HH:mm - HH:mm`; daftar kosong jika tidak dikirim. |
| `$totalSesiMengajar` | int | total sesi pada footer dan dokumen cetak | `5` | dipakai | Nilai ringkasan berasal dari jadwal yang dikirim backend. |
| `$jadwalTerverifikasi` | bool | kondisi teks verifikasi kurikulum | `true` | perlu konfirmasi backend | Teks verifikasi hanya ditampilkan jika bernilai `true`; sumber kolom/status verifikasi belum dikonfirmasi. |
| `$namaSekolah` | string | nama sekolah pada dokumen cetak | `SMK Nusantara` | perlu konfirmasi backend | Identitas sekolah untuk kop dokumen. |
| `$alamatSekolah` | string | alamat pada kop dokumen cetak | `Kapencar RT. 10 RW. 09, ...` | perlu konfirmasi backend | Kirim sebagai teks siap tampil; fallback `-`. |
| `$namaKepalaSekolah` | string | nama penanda tangan | `Nama Kepala Sekolah` | perlu konfirmasi backend | Fallback `-`. |
| `$nipKepalaSekolah` | string | NIP penanda tangan | `-` | perlu konfirmasi backend | Fallback `-`. |
| `$lokasiSekolah` | string | lokasi pada tanggal cetak | `Wonosobo` | perlu konfirmasi backend | Fallback `-`. |
| `$tanggalCetak` | Carbon | tanggal pada dokumen | `Carbon::parse("2026-11-13")` | perlu konfirmasi backend | View menampilkan dengan `format('d F Y')`; locale bulan mengikuti konfigurasi Carbon. |

### Input Nilai

View: `guru/input-nilai.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$kelasOptions` | array/collection | string nama kelas | `["X TKJ 1", "X TKJ 2"]` | dipakai | Daftar opsi rombongan belajar. |
| `$mataPelajaranOptions` | array/collection | string nama mata pelajaran | `["Dasar Jaringan", "Mesin Otomotif"]` | dipakai | Daftar opsi mata pelajaran. |
| `$kelasNilaiTerpilih` | string | kelas awal yang dipilih | `X TKJ 1` | dipakai | Fallback string kosong. |
| `$mataPelajaranNilaiTerpilih` | string | mata pelajaran awal yang dipilih | `Dasar Jaringan` | dipakai | Fallback string kosong. |
| `$nilaiSiswa` | array/object JSON-serializable | key nama kelas; baris `nis`, `nama`, `kehadiran`, `nilai`, `status`, `catatan` | `{"X TKJ 1": [{"nis": "20261001", "nama": "Nama Siswa", "kehadiran": 100, "nilai": 85, "status": "Tuntas", "catatan": ""}]}` | dipakai | Bentuk data mempertahankan lookup Alpine berdasarkan kelas; fallback objek kosong. |
| `$kkmNilai` | int | batas nilai untuk status ketuntasan | `70` | perlu konfirmasi backend | Fallback mempertahankan nilai yang saat ini digunakan; aturan KKM perlu dipastikan. |
| `$statusNilaiOptions` | array/collection | string status | `["Tuntas", "Belum Tuntas"]` | dipakai | Opsi status memiliki fallback yang mempertahankan pilihan saat ini. |

### Penilaian Sikap & P5

View: `guru/penilaian-sikap.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$kelasOptions` | array/collection | string nama kelas | `["X TKJ 1", "X TKJ 2"]` | dipakai | Sama dengan daftar kelas pada Input Nilai dan Riwayat Jurnal. |
| `$kelasSikapTerpilih` | string | kelas awal yang dipilih | `X TKJ 1` | dipakai | Fallback string kosong. |
| `$dimensiOptions` | array/collection | string nama dimensi | `["Bergotong Royong", "Mandiri"]` | perlu konfirmasi backend | Sumber daftar dimensi perlu dikonfirmasi; fallback koleksi kosong. |
| `$dimensiSikapTerpilih` | string | dimensi awal yang dipilih | `Bergotong Royong` | dipakai | Fallback string kosong. |
| `$predikatOptions` | array/collection | `kode`, `label` | `[{kode: "SB", label: "Sangat Baik (SB)"}]` | perlu konfirmasi backend | Kode perlu cocok dengan pemetaan warna di Alpine; fallback koleksi kosong. |
| `$catatanSikap` | array/object JSON-serializable | key nama kelas; baris `nis`, `nama`, `predikat`, `deskripsi` | `{"X TKJ 1": [{"nis": "20261001", "nama": "Nama Siswa", "predikat": "SB", "deskripsi": ""}]}` | dipakai | Bentuk data mempertahankan lookup Alpine berdasarkan kelas; fallback objek kosong. |

### Riwayat Jurnal

View: `guru/riwayat-jurnal.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$tanggalJurnal` | string `Y-m-d` | tanggal awal pada input | `2026-11-13` | dipakai | Nilai input HTML tanggal harus dikirim sebagai string `Y-m-d`. |
| `$kelasOptions` | array/collection | string nama kelas | `["X TKJ 1", "X TKJ 2"]` | dipakai | Sama dengan daftar kelas pada Input Nilai dan Penilaian Sikap. |
| `$mataPelajaranOptions` | array/collection | string nama mata pelajaran | `["Dasar Jaringan", "Mesin Otomotif"]` | dipakai | Sama dengan daftar mata pelajaran pada Input Nilai. |
| `$kelasJurnalTerpilih` | string | kelas awal yang dipilih | `X TKJ 1` | dipakai | Fallback string kosong. |
| `$mataPelajaranJurnalTerpilih` | string | mata pelajaran awal yang dipilih | `Dasar Jaringan` | dipakai | Fallback string kosong. |
| `$materiPokok` | string | materi awal | `Pengenalan Topologi Star & Ring` | perlu konfirmasi backend | Sumber materi awal belum diketahui; fallback string kosong. |
| `$siswaJurnal` | collection/array JSON-serializable | `nis`, `nama`, `presensi`, `status`, `nilai`, `catatan` | `[{nis: "20261001", nama: "Nama Siswa", presensi: "Hadir", status: "Tuntas", nilai: 85, catatan: ""}]` | dipakai | Fallback daftar kosong. |
| `$statusPresensiOptions` | array/collection | string status presensi | `["Hadir", "Sakit", "Izin", "Alpa"]` | dipakai | Fallback mempertahankan pilihan status yang saat ini tampil. |
| `$statusCapaianOptions` | array/collection | string status capaian | `["Belum Dinilai", "Tuntas", "Perlu Bimbingan"]` | dipakai | Fallback mempertahankan pilihan status yang saat ini tampil. |
| `$kkmJurnal` | int | batas nilai untuk status capaian | `75` | perlu konfirmasi backend | Fallback mempertahankan nilai yang saat ini digunakan; aturan KKM perlu dipastikan. |
| `$terakhirDisimpan` | string | teks waktu penyimpanan terakhir | `1 menit lalu` | perlu konfirmasi backend | Fallback `-`; mekanisme dan format waktu perlu dipastikan backend. |

### Profil Pengguna

View: `guru/profil-pengguna.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$guruPosition` | string | jabatan dan unit tugas pada kartu profil | `Guru Kejuruan - SMK Nusantara` | perlu konfirmasi backend | Kirim sebagai teks siap tampil; sumber jabatan/unit belum dikonfirmasi. |
| `$statusAkun` | string | badge status akun | `Akun Terverifikasi` | perlu konfirmasi backend | Status sumber akun belum dipastikan. |
| `$statusNuptk` | string | status NUPTK | `Aktif` | perlu konfirmasi backend | Sumber status NUPTK belum dikonfirmasi. |
| `$profilGuru` | object/array | `email`, `telepon`, `diperbarui` | `{email: "guru@example.test", telepon: "081234567890", diperbarui: "13 November 2026"}` | perlu konfirmasi backend | Objek dikirim ke Alpine; fallback menjaga field tetap tersedia dengan nilai kosong atau `-`. |

### Form & Aksi

Daftar berikut hanya mencatat kebutuhan tampilan. Form, action/method, `@csrf`, dan logika JavaScript/Alpine yang sudah ada tidak diubah.

| Halaman | Form/tombol | Action atau handler saat ini | Kebutuhan route dari sisi tampilan | Catatan |
|---|---|---|---|---|
| Beranda Guru | `Isi Jurnal` | Baris jadwal memakai `$jadwalItem->aksiUrl ?? '#'` | GET ke halaman input jurnal untuk sesi terkait | URL/rute belum dikonfirmasi backend; fallback tetap `#`. |
| Jadwal Mengajar | `Cetak Jadwal`, kembali, dan `Cetak Dokumen` | Perpindahan tampilan Alpine dan `window.print()` | Tidak memerlukan route untuk aksi cetak saat ini | Dipertahankan. |
| Input Nilai | Simpan Semua Nilai | Form POST ke `guru.input-nilai`, `@csrf`, submit dicegah oleh `simpan()` | POST simpan nilai untuk kelas/mapel terpilih | Handler saat ini hanya menampilkan notifikasi lokal; pencatatan server belum jelas. |
| Penilaian Sikap & P5 | Simpan Evaluasi | Form POST ke `#`, `@csrf`, submit dicegah oleh `simpan()` | POST simpan evaluasi sikap/P5 | Action belum memiliki route; handler hanya menampilkan notifikasi lokal. |
| Riwayat Jurnal | Kembali ke Riwayat Jurnal | `href="#"` | GET ke daftar Riwayat Jurnal | Route tujuan belum jelas. |
| Riwayat Jurnal | Set Semua Hadir & Tuntas | `setSemua()` mengubah state Alpine | Tidak memerlukan route tersendiri | Perubahan dikirim melalui form simpan jika backend menghubungkannya. |
| Riwayat Jurnal | Simpan Jurnal | Form POST ke `#`, `@csrf`, submit dicegah oleh `simpan()` | POST simpan jurnal dan evaluasi harian | Action belum memiliki route; handler saat ini hanya simulasi lokal. |
| Profil Pengguna | Simpan Perubahan | Form POST ke `#`, `@csrf`, submit dicegah oleh `simpanProfil()` | PUT/PATCH perbarui profil | Action belum memiliki route; handler hanya notifikasi lokal. |
| Profil Pengguna | Perbarui Sandi | Form POST ke `#`, `@csrf`, submit dicegah oleh `simpanSandi()` | POST/PUT/PATCH perubahan kata sandi | Action belum memiliki route; form autentikasi tidak diubah. |
| Layout Guru | Keluar / Logout | Form POST ke `logout` dengan `@csrf` | Tidak ada perubahan | Form logout dipertahankan. |

## Portal TU

### Variabel Global Layout

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | View pemakai | Catatan |
|---|---|---|---|---|---|---|
| `$tuUser` | object/null | `name`, `role` | `{name: "Nur Fina", role: "pihak_yayasan"}` | dipakai | `layouts/tu.blade.php` | Diambil dari `Auth::user()` di layout; tidak perlu dikirim controller. |
| `$tuName` | string | nama untuk topbar, sapaan, dan tanda tangan dokumen | `Nur Fina` | dipakai | Layout dan seluruh view TU | Topbar membaca dari `Auth::user()`; view yang menampilkan nama pada konten juga mengambil nama login. Teks sapaan `Ibu` tetap dipertahankan oleh view. |
| `$tuInitials` | string | inisial avatar | `NF` | dipakai | Layout, `tu/profil-pengguna.blade.php` | Dihitung otomatis dari nama login. |
| `$tuRole` | string | jabatan/peran topbar | `Staf TU` | dipakai | `layouts/tu.blade.php` | Diambil dari role user; `pihak_yayasan` ditampilkan sebagai `Staf TU`. |
| `$tahunAjaran` | string | badge tahun ajaran dan keterangan transaksi | `2026/2027` | dipakai | Semua view TU | Badge menjadi `Tahun Ajaran -` bila kosong. |
| `$versi` | string | versi sistem pada footer dan dokumen | `2.4.0` | perlu konfirmasi backend | Semua view TU | Sebelumnya tertulis tetap di view; sumber nilai versi belum diketahui. Fallback `-`. |
| `$namaYayasan` | string | nama yayasan pada footer/kop dokumen | `Yayasan Pendidikan Nurun 'Alannur` | perlu konfirmasi backend | Semua view TU | Kirim sebagai teks siap tampil. |
| `$namaSekolah` | string | nama sekolah pada dashboard dan laporan | `SMK Nusantara` | perlu konfirmasi backend | Dashboard, Rekapitulasi Keuangan | Nama unit/sekolah yang tampil di kartu dan kop laporan. |
| `$alamatSekolah` | string | alamat pada kop dokumen | `Kapencar RT. 10 RW. 09, Kecamatan Kertek, ...` | perlu konfirmasi backend | Transaksi Pembayaran, Rekapitulasi Keuangan | Alamat lengkap siap tampil; fallback `-`. |
| `$tuId` | string | ID penanda tangan TU | `TU-202604` | perlu konfirmasi backend | Transaksi Pembayaran, Rekapitulasi Keuangan | Sumber ID belum jelas; jangan menganggap ID ini sama dengan NIP. |

### Beranda TU

View: `tu/dashboard.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$tuName` | string | nama pada sapaan | `Nur Fina` | dipakai | Berasal dari user login; awalan `Ibu` dipertahankan di view. |
| `$tahunAjaran` | string | badge topbar | `2026/2027` | dipakai | Lihat variabel global. |
| `$pemasukanHariIni` | int | total pemasukan hari ini | `1450000` | dipakai | Nilai mentah rupiah; diformat dengan pemisah ribuan di view. |
| `$jumlahTransaksiHariIni` | int | jumlah transaksi pada kartu | `6` | dipakai | Fallback `0`. |
| `$jumlahSiswaTertunggak` | int | jumlah siswa dengan tagihan tertunggak | `12` | dipakai | Fallback `0`. |
| `$namaSekolah` | string | unit sekolah di kartu tunggakan | `SMK Nusantara` | perlu konfirmasi backend | Lihat variabel global. |
| `$saldoTabunganMi` | int | total saldo tabungan MI | `8200000` | dipakai | Nilai mentah rupiah; diformat dengan pemisah ribuan di view. |
| `$waktuPembaruanTransaksi` | string | teks waktu pembaruan | `Hari ini, 10:15 WIB` | perlu konfirmasi backend | Kirim dengan format siap tampil. |
| `$transaksiHariIni` | collection/array | `waktu`, `kodeReferensi`, `namaSiswa`, `nis`, `unit`, `jenis`, `nominal`, `status` | `[{waktu: "09:15 WIB", kodeReferensi: "TRX-001", namaSiswa: "Nama Siswa", nis: "20261001", unit: "SMK Nusantara", jenis: "SPP Bulanan", nominal: 250000, status: "Lunas"}]` | dipakai | `@forelse`; status `Lunas`/`Sukses` memakai gaya hijau, `Cicilan` memakai gaya amber, status lain memakai gaya netral. Baris kosong memakai teks yang sudah disediakan. |
| `$jumlahTransaksiTerbaru` | int | jumlah transaksi pada footer tabel | `3` | perlu konfirmasi backend | Nilainya merujuk transaksi yang ditampilkan pada tabel; fallback `0`. |
| `$namaYayasan` | string | teks footer identitas sistem | `Yayasan Pendidikan Nurun 'Alannur` | perlu konfirmasi backend | Lihat variabel global. |
| `$versi` | string | versi sistem | `2.4.0` | perlu konfirmasi backend | Lihat variabel global. |

### Transaksi Pembayaran

View: `tu/transaksi-pembayaran.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$tahunAjaran` | string | badge dan teks tahun ajaran pada kwitansi lokal | `2026/2027` | dipakai | Nilai juga menjadi sumber string tahun pada kwitansi yang dibuat oleh handler Alpine. |
| `$jenisPembayaranOptions` | array/collection | string jenis pembayaran | `["SPP Bulanan", "Setor Tabungan", "Seragam Olahraga", "Uang Kegiatan"]` | perlu konfirmasi backend | Mengisi pilihan jenis pada form; bila kosong daftar pilihan kosong. |
| `$siswaOptions` | array/collection JSON-serializable | `nis`, `nama`, `kelas`, `unit` | `[{nis: "20261001", nama: "Nama Siswa", kelas: "X TKJ 1", unit: "SMK Nusantara"}]` | perlu konfirmasi backend | Disematkan ke Alpine untuk pencarian/pemilihan siswa; properti pencarian `nama` dan `nis` perlu berupa string. |
| `$riwayatTransaksi` | array/collection JSON-serializable | `ref`, `label`, `waktu`, `lengkap`, `cetak`, `nis`, `nama`, `kelas`, `unit`, `jenis`, `detail`, `nada`, `untuk`, `untukKet`, `ket`, `nominal`, `status` | `[{ref: "TRX-001", label: "Hari ini", waktu: "09:15 WIB", lengkap: "29 Oktober 2026, 09:15 WIB", cetak: "29/10/2026 09:15 WIB", nis: "20261001", nama: "Nama Siswa", kelas: "X TKJ 1", unit: "SMK Nusantara", jenis: "SPP Bulanan", detail: "Pembayaran Reguler", nada: "hijau", untuk: "SPP Bulan Oktober 2026", untukKet: "(Pembayaran Reguler - Tahun Ajaran 2026/2027)", ket: "", nominal: 250000, status: "Lunas"}]` | dipakai | Disematkan ke Alpine; `nada` mempertahankan kondisi warna detail transaksi. Sertakan `status` untuk tampilan status pada kwitansi. |
| `$namaYayasan` | string | kop/footer kwitansi dan footer aplikasi | `Yayasan Pendidikan Nurun 'Alannur` | perlu konfirmasi backend | Lihat variabel global. |
| `$alamatSekolah` | string | alamat pada kop kwitansi | `Kapencar RT. 10 RW. 09, Kecamatan Kertek, ...` | perlu konfirmasi backend | Lihat variabel global. |
| `$tuName` | string | nama penerima pada kwitansi | `Nur Fina` | dipakai | Berasal dari user login; awalan `Ibu` dipertahankan di view. |
| `$tuId` | string | ID penerima pada kwitansi | `TU-202604` | perlu konfirmasi backend | Lihat variabel global. |
| `$versi` | string | versi footer kwitansi dan aplikasi | `2.4.0` | perlu konfirmasi backend | Lihat variabel global. |

### Rekapitulasi Keuangan

View: `tu/rekapitulasi-keuangan.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$tahunAjaran` | string | badge topbar | `2026/2027` | dipakai | Lihat variabel global. |
| `$bulanOptions` | array/collection | string bulan pada filter | `["September 2026", "Oktober 2026"]` | dipakai | Menjadi daftar bulan Alpine; fallback koleksi kosong. |
| `$bulanTerpilih` | string | bulan awal terpilih | `Oktober 2026` | perlu konfirmasi backend | Harus cocok dengan salah satu nilai `$bulanOptions`; fallback string kosong. |
| `$unitOptions` | array/collection | string nama unit | `["SMK Nusantara", "MI Internasional"]` | perlu konfirmasi backend | Opsi “Semua Unit” tetap ada terpisah. |
| `$jenisTransaksiOptions` | array/collection | string jenis transaksi | `["SPP", "Tabungan", "Seragam"]` | perlu konfirmasi backend | Opsi “Semua Jenis Transaksi” tetap ada terpisah. |
| `$ringkasanKeuangan` | object/array JSON-serializable | key bulan; `pemasukan`, `piutang`, `siswa` | `{"Oktober 2026": {"pemasukan": 15450000, "piutang": 3000000, "siswa": 24}}` | dipakai | Disematkan ke Alpine untuk kartu ringkasan berdasarkan bulan. Nominal dan jumlah siswa berupa angka. |
| `$transaksiKeuangan` | array/collection JSON-serializable | `bulan`, `tgl`, `uraian`, `unit`, `jenis`, `nominal`, `status` | `[{bulan: "Oktober 2026", tgl: "25 Okt 2026", uraian: "Pembayaran SPP", unit: "SMK Nusantara", jenis: "SPP", nominal: 3750000, status: "Tercatat"}]` | dipakai | Disematkan ke Alpine untuk filter, tabel, cetak, dan ekspor CSV. |
| `$namaYayasan` | string | kop dan footer dokumen | `Yayasan Pendidikan Nurun 'Alannur` | perlu konfirmasi backend | Lihat variabel global. |
| `$namaSekolah` | string | nama unit pada kop laporan | `SMK Nusantara` | perlu konfirmasi backend | Lihat variabel global. |
| `$alamatSekolah` | string | alamat kop laporan | `Kapencar RT. 10 RW. 09, Kecamatan Kertek, ...` | perlu konfirmasi backend | Lihat variabel global. |
| `$namaKepalaKeuangan` | string | nama penanda tangan laporan | `Nama Kepala Bagian Keuangan` | perlu konfirmasi backend | Sumber nama penanda tangan belum diketahui; fallback `-`. |
| `$nipKepalaKeuangan` | string | NIP penanda tangan laporan | `-` | perlu konfirmasi backend | Sumber NIP belum diketahui; fallback `-`. |
| `$lokasiSekolah` | string | lokasi pada tanggal cetak | `Wonosobo` | perlu konfirmasi backend | Lihat variabel global/identitas sekolah; fallback `-`. |
| `$catatanValidasiLaporan` | string | catatan validasi pada dokumen cetak | `Data transaksi telah divalidasi oleh sistem perbendaharaan.` | perlu konfirmasi backend | Kirim sebagai kalimat siap tampil; view memiliki fallback copy yang saat ini digunakan. |
| `$tuName` | string | nama staf TU penanda tangan laporan | `Nur Fina` | dipakai | Berasal dari user login. |
| `$tuId` | string | ID staf TU pada laporan | `TU-202604` | perlu konfirmasi backend | Lihat variabel global. |
| `$versi` | string | versi sistem pada footer | `2.4.0` | perlu konfirmasi backend | Lihat variabel global. |

### Profil Pengguna

View: `tu/profil-pengguna.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$tahunAjaran` | string | badge topbar | `2026/2027` | dipakai | Lihat variabel global. |
| `$tuName` | string | nama kartu identitas dan input nama | `Nur Fina` | dipakai | Berasal dari user login; awalan `Ibu` dipertahankan di view. |
| `$tuInitials` | string | inisial avatar kartu identitas | `NF` | dipakai | Dihitung dari nama login di view. |
| `$tuJabatan` | string | jabatan dan unit pada kartu identitas | `Staf Tata Usaha - Yayasan Nurun 'Alannur` | perlu konfirmasi backend | Kirim sebagai teks siap tampil; sumber jabatan/unit belum diketahui. |
| `$statusKepegawaian` | string | teks badge status kepegawaian | `Aktif Kepegawaian TU` | perlu konfirmasi backend | Label status siap tampil; fallback `-`. |
| `$statusKepegawaianWarna` | string | warna badge status kepegawaian | `aktif` | perlu konfirmasi backend | Nilai `aktif` memakai gaya hijau; nilai lain memakai gaya netral. |
| `$loketKasir` | string | nomor loket | `Loket Kasir #01` | perlu konfirmasi backend | Sumber nomor loket belum diketahui. |
| `$statusAkun` | string | badge status akun | `Akun Terverifikasi` | perlu konfirmasi backend | Label status siap tampil; fallback `-`. |
| `$statusAkunWarna` | string | warna badge status akun | `aktif` | perlu konfirmasi backend | Nilai `aktif` memakai gaya hijau; nilai lain memakai gaya netral. |
| `$tuNip` | string | input NIP/NIK | `19921105003` | perlu konfirmasi backend | Kirim sebagai string; jangan menganggap `tuId` sebagai NIP. |
| `$profilTu` | object/array | `email`, `telepon`, `diperbarui` | `{email: "tu@example.test", telepon: "081234567890", diperbarui: "25 Oktober 2026"}` | perlu konfirmasi backend | Disematkan ke Alpine untuk mengisi field profil; data kata sandi tidak disimpan dalam objek ini. |
| `$namaYayasan` | string | teks footer identitas sistem | `Yayasan Pendidikan Nurun 'Alannur` | perlu konfirmasi backend | Lihat variabel global. |
| `$versi` | string | versi sistem | `2.4.0` | perlu konfirmasi backend | Lihat variabel global. |

### Form & Aksi

Daftar ini hanya mencatat kebutuhan tampilan. Action, method, `@csrf`, dan handler Alpine tidak diubah.

| Halaman | Form/tombol | Action atau handler saat ini | Kebutuhan route dari sisi tampilan | Catatan |
|---|---|---|---|---|
| Beranda TU | Lihat Semua Transaksi | `href="#"` | GET ke halaman Transaksi Pembayaran | Route tujuan belum jelas. |
| Transaksi Pembayaran | Input Pembayaran Baru | Form `POST` ke `#`, `@csrf`, `@submit.prevent="simpan()"` | POST untuk menyimpan pembayaran dan menghasilkan kwitansi | Saat ini submit dicegah dan transaksi hanya disimpan sementara di Alpine. |
| Transaksi Pembayaran | Buka Rekapitulasi Lengkap | `href="#"` | GET ke Rekapitulasi Keuangan | Route tujuan belum jelas. |
| Transaksi Pembayaran | Cetak PDF/Kwitansi | `bukaKwitansi()` dan `window.print()` | Tidak memerlukan route untuk cetak lokal saat ini | Data kwitansi bersumber dari objek transaksi pada Alpine. |
| Rekapitulasi Keuangan | Unduh Excel | `unduhExcel()` membuat CSV di browser | Tidak memerlukan route untuk ekspor lokal saat ini | Data transaksi berasal dari `$transaksiKeuangan`; tombol Cetak PDF menggunakan pratinjau dan `window.print()`. |
| Profil Pengguna | Simpan Perubahan | Form `POST` ke `#`, `@csrf`, `@submit.prevent="simpanProfil()"` | PATCH/PUT untuk memperbarui profil | Saat ini hanya simulasi lokal. |
| Profil Pengguna | Perbarui Sandi | Form `POST` ke `#`, `@csrf`, `@submit.prevent="simpanSandi()"` | POST/PATCH untuk mengubah kata sandi | Saat ini hanya simulasi lokal. |
| Layout TU | Keluar / Logout | Form POST ke `logout` dengan `@csrf` | Tidak ada perubahan | Form logout dipertahankan. |

## Portal Wali Murid

### Konvensi Portal Wali Murid

- Nama variabel mengikuti `camelCase`; angka berupa `int`; tanggal berupa `Carbon` atau string `Y-m-d`.
- Daftar yang dikirim ke Alpine dapat berupa array/collection yang JSON-serializable. Struktur data mengikuti field yang dicantumkan per view.
- Data user login di topbar dibaca dari `Auth::user()` oleh `layouts/wali.blade.php`; layout menghitung inisial dan label role, sehingga controller tidak perlu mengirim variabel topbar terpisah.
- Data `isi`/`deskripsi` aktivitas atau P5 yang dipakai melalui `x-html` perlu berupa HTML aman/terkontrol. Data lain tetap ditampilkan melalui Blade escaped atau Alpine `x-text`.

### Variabel Global Layout

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | View pemakai | Catatan |
|---|---|---|---|---|---|---|
| `$tahunAjaran` | string | label badge tahun ajaran | `2026/2027` | dipakai | Semua halaman Wali Murid | Layout dan setiap halaman menggunakan fallback `-`. |
| `Auth::user()` | object/null | `name`, `role` | `{name: "Nama Wali", role: "orang_tua"}` | dipakai | `layouts/wali.blade.php`, semua halaman portal melalui topbar | Dibaca langsung di layout. Inisial dan label role dihitung layout, bukan variabel controller. |
| `$siswa` | object | `nama`, `inisial`, `nis`, `nisn`, `kelas`, `sekolah`, `status` | `{nama: "Nama Siswa", inisial: "NS", nis: "20261001", nisn: "0081234567", kelas: "X TKJ 1", sekolah: "SMK Nusantara", status: "Aktif"}` | perlu konfirmasi backend | Dashboard, Rapor Akademik, KBM Mingguan, Jurnal Sikap & P5, Tagihan & Pembayaran, Profil Akun | Objek identitas siswa yang sama digunakan lintas halaman. |
| `$waliKelas` | object | `nama`, `inisial`, `kelas`, `telepon`, `email`, `jamKonsultasi`, `nip` | `{nama: "Nama Guru", inisial: "NG", kelas: "X TKJ 1", telepon: "081234567890", email: "guru@example.test", jamKonsultasi: "Senin-Jumat", nip: "-"}` | perlu konfirmasi backend | Dashboard, KBM Mingguan, Jurnal Sikap & P5, Rapor Akademik | Kirim field yang digunakan masing-masing halaman; NIP boleh `null`. |
| `$namaYayasan` | string | nama yayasan pada teks informasi/dokumen | `Yayasan Pendidikan` | perlu konfirmasi backend | Semua halaman Wali Murid | Data identitas institusi; fallback `-`. |
| `$unitPendidikan` | string | daftar unit pada teks footer | `SMK Nusantara & MI Internasional` | perlu konfirmasi backend | Rapor Akademik, KBM Mingguan, Tagihan & Pembayaran, Profil Akun | Label unit yang tercakup dalam sistem; fallback `-`. |
| `$versi` | string | versi sistem pada footer | `2.4.0` | perlu konfirmasi backend | Semua halaman Wali Murid | Sebelumnya ditulis statis; sumber versi perlu dipastikan. |
| `$ringkasanKeuangan` | object | `statusSpp`, `statusVerifikasi`, `periodeSpp`, `pesanStatusSpp`, `statusAdministrasi`, `periodeBerikutnya`, `jatuhTempo`, `totalTagihanLainnya`, `pesanTagihanLainnya`, `biayaTambahanSemester` | `{statusSpp: "LUNAS", statusVerifikasi: "Terverifikasi", periodeSpp: "Oktober", periodeBerikutnya: "November", jatuhTempo: "10 Nov", totalTagihanLainnya: 0}` | perlu konfirmasi backend | Dashboard, Tagihan & Pembayaran | Properti yang dipakai bergantung halaman. `totalTagihanLainnya` berupa angka; status SPP `LUNAS` memakai gaya hijau, status lain gaya merah. |

### Beranda Utama

View: `wali-murid/dashboard.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$siswa` | object | `nama`, `inisial`, `nis`, `kelas`, `sekolah`, `status` | Lihat variabel global | perlu konfirmasi backend | Status `Aktif` menggunakan gaya badge yang sudah ada; status lain menggunakan gaya netral. |
| `$waliKelas` | object | `nama`, `inisial`, `kelas`, `telepon`, `email`, `jamKonsultasi` | Lihat variabel global | perlu konfirmasi backend | Dipakai pada kartu kontak dan modal. |
| `$tahunAjaran` | string | badge tahun ajaran | `2026/2027` | dipakai | Lihat variabel global. |
| `$semester` | string | ringkasan semester | `Ganjil` | perlu konfirmasi backend | Nilai semester aktif; fallback `-`. |
| `$persentaseKehadiran` | int | angka dan lebar indikator kehadiran | `96` | perlu konfirmasi backend | Fallback `0`; persentase diharapkan dalam rentang 0–100. |
| `$labelDisiplin` | string | badge disiplin | `Sangat Baik` | perlu konfirmasi backend | Sumber label belum diketahui. |
| `$jumlahHadir` | int | jumlah kehadiran | `24` | perlu konfirmasi backend | Fallback `0`. |
| `$jumlahSakitIzin` | int | jumlah sakit/izin | `2` | perlu konfirmasi backend | Fallback `0`. |
| `$ringkasanKeuangan` | object | `statusSpp`, `statusVerifikasi`, `periodeSpp`, `pesanStatusSpp` | Lihat variabel global | perlu konfirmasi backend | Digunakan untuk kartu status SPP. |
| `$peringatanAkademik` | object | `status`, `label`, `keterangan`, `sumberPantauan` | `{status: "Aman", label: "Tidak Ada", keterangan: "Tidak ada peringatan aktif", sumberPantauan: "Pemantauan wali kelas"}` | perlu konfirmasi backend | Teks status dan penjelasan berasal dari backend. |
| `$aktivitas` | array/collection JSON-serializable | `waktu`, `tag.teks`, `tag.kelas`, `ikon.wadah`, `ikon.svg`, `isi`, `detail`, `lencana.teks`, `lencana.kelas` | `[{waktu: "25 Okt 2026", tag: {teks: "Akademik", kelas: "..."}, ikon: {wadah: "...", svg: "<path ...>"}, isi: "Pembaruan nilai", detail: "Rincian", lencana: {teks: "Tuntas", kelas: "..."}}]` | perlu konfirmasi backend | Disematkan ke Alpine dengan `@json`; bentuk harus mengikuti struktur contoh. `isi` dirender menggunakan `x-html`, sehingga hanya kirim HTML tepercaya. |
| `$agendaAkademik` | string | teks agenda | `Ujian tengah semester` | perlu konfirmasi backend | Sumber dan teks agenda belum diketahui. |
| `$pesanPendampingan` | string | catatan pendampingan | `Mohon mendampingi belajar di rumah.` | perlu konfirmasi backend | Kirim teks siap tampil. |
| `$undanganPertemuan` | string | teks undangan | `Pertemuan orang tua` | perlu konfirmasi backend | Sumber agenda pertemuan belum diketahui. |
| `$informasiPertemuan` | string | detail waktu/lokasi pertemuan | `Jumat, 10.00 WIB` | perlu konfirmasi backend | Kirim teks siap tampil. |
| `$versi` | string | footer versi | `2.4.0` | perlu konfirmasi backend | Lihat variabel global. |
| `$namaYayasan` | string | teks integrasi yayasan | `Yayasan Pendidikan` | perlu konfirmasi backend | Lihat variabel global. |

### Rapor Akademik

View: `wali-murid/rapor-akademik.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$siswa` | object | `nama`, `nis`, `nisn`, `kelas`, `sekolah` | Lihat variabel global | perlu konfirmasi backend | Identitas tabel dan dokumen cetak. |
| `$waliKelas` | object | `nama`, `nip` | Lihat variabel global | perlu konfirmasi backend | Dipakai pada kartu identitas dan tanda tangan dokumen. |
| `$profilWali` | object | `nama` | `{nama: "Nama Wali"}` | perlu konfirmasi backend | Nama orang tua/wali untuk tanda tangan. |
| `$kepalaSekolah` | object | `nama`, `nip` | `{nama: "Nama Kepala Sekolah", nip: "1980000000000000"}` | perlu konfirmasi backend | Data penanda tangan; fallback `-`. |
| `$semesterTerpilih` | string | pilihan semester awal | `Ganjil 2026/2027` | perlu konfirmasi backend | Harus sesuai salah satu nilai pada `$semesterOptions`. |
| `$semesterOptions` | array/collection | string label semester | `["Ganjil 2026/2027", "Genap 2025/2026"]` | perlu konfirmasi backend | Opsi dropdown dibuat Alpine dari daftar ini. |
| `$nilaiRapor` | array/object JSON-serializable | key label semester; `mapel`, `titik`, `kkm`, `nilai`, `deskripsi` | `{"Ganjil 2026/2027": [{"mapel": "Matematika", "titik": "bg-amber-500", "kkm": 70, "nilai": 85, "deskripsi": "Kemajuan belajar"}]}` | perlu konfirmasi backend | Dipakai tabel layar dan cetak. `kkm`/`nilai` berupa angka; nilai CSS `titik` harus mengikuti palet kelas yang sudah ada. |
| `$tahunAjaran` | string | badge tahun ajaran | `2026/2027` | dipakai | Lihat variabel global. |
| `$namaYayasan` | string | kop/footer | `Yayasan Pendidikan` | perlu konfirmasi backend | Lihat variabel global. |
| `$namaSekolah` | string | kop sekolah | `SMK Nusantara` | perlu konfirmasi backend | Identitas sekolah pada dokumen cetak. |
| `$alamatSekolah` | string | alamat kop dokumen | `Alamat sekolah` | perlu konfirmasi backend | Teks siap tampil. |
| `$akreditasiSekolah` | string | nilai akreditasi | `A` | perlu konfirmasi backend | Fallback `-`. |
| `$kurikulum` | string | nama kurikulum | `Kurikulum Merdeka` | perlu konfirmasi backend | Sumber kurikulum belum dikonfirmasi. |
| `$jenjangSekolah` | string | jenjang sekolah | `Sekolah Menengah Kejuruan` | perlu konfirmasi backend | Teks siap tampil. |
| `$programKeahlian` | string | program pada identitas cetak | `Teknik Komputer & Jaringan` | perlu konfirmasi backend | Nama program keahlian siswa. |
| `$lokasiSekolah` | string | lokasi pada tanda tangan | `Wonosobo` | perlu konfirmasi backend | Lihat data identitas sekolah. |
| `$unitPendidikan` | string | teks petunjuk dokumen | `SMK Nusantara & MI Internasional` | perlu konfirmasi backend | Teks unit yang tercakup dalam sistem. |
| `$waktuSinkronisasi` | string | waktu sinkronisasi pada footer | `Hari ini, 10:00 WIB` | perlu konfirmasi backend | Kirim teks siap tampil; format belum ditentukan. |
| `$versi` | string | footer versi dokumen | `2.4.0` | perlu konfirmasi backend | Lihat variabel global. |

### Jurnal KBM Mingguan

View: `wali-murid/kbm-mingguan.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$siswa` | object | `nama`, `inisial`, `nis`, `kelas`, `sekolah`, `status` | Lihat variabel global | perlu konfirmasi backend | Kartu siswa; status ditampilkan sebagai teks. |
| `$waliKelas` | object | `nama`, `kelas` | Lihat variabel global | perlu konfirmasi backend | Dipakai pada kartu dan keterangan verifikasi sanggahan. |
| `$bulanOptions` | array/collection | string nama bulan dan tahun | `["September 2026", "Oktober 2026"]` | perlu konfirmasi backend | Mengisi pilihan bulan filter; label dan nilai option sama. |
| `$mingguOptions` | array/collection | nomor minggu | `["1", "2", "3", "4"]` | perlu konfirmasi backend | Nilai option digunakan sebagai key dalam gabungan bulan/minggu. |
| `$bulanTerpilih` | string | pilihan bulan Alpine | `Oktober 2026` | perlu konfirmasi backend | Harus cocok dengan `$bulanOptions`; fallback string kosong. |
| `$mingguTerpilih` | string | pilihan minggu Alpine | `4` | perlu konfirmasi backend | Harus cocok dengan `$mingguOptions`; fallback string kosong. |
| `$jurnalKbm` | object/array JSON-serializable | key gabungan `bulan|minggu`; nilai `rentang`, `sesi`, `update`, `baris`; tiap baris memakai `id`, `tgl`, `hari`, `bln`, `tahun`, `jam`, `mapel`, `guru`, `materi`, `status`, `nilai`, `catatan`, `hadir`, `tanggapan`, `sanggahan` | `{"Oktober 2026|4": {"rentang": "26 - 30 Oktober 2026", "sesi": 5, "update": "28 Okt 2026", "baris": [{"id": 1, "tgl": "26", "hari": "Senin", "bln": "Okt", "tahun": "2026", "jam": "07:30 - 09:45", "mapel": "Matematika", "guru": "Nama Guru", "materi": "Aljabar", "status": "Tuntas", "nilai": 85, "catatan": "-", "hadir": "Hadir", "tanggapan": false, "sanggahan": false}]}}` | perlu konfirmasi backend | Objek dikelompokkan memakai key persis `bulanTerpilih + "|" + mingguTerpilih`; `sesi`/`nilai` angka, `tanggapan`/`sanggahan` boolean. Daftar tidak tersedia menghasilkan tabel kosong. |
| `$alasanKoreksiOptions` | array/collection | string alasan sanggahan | `["Anak sakit (ada surat dokter)", "Izin keperluan keluarga"]` | perlu konfirmasi backend | Opsi kosong “Pilih kendala...” tetap statis. |
| `$namaYayasan` | string | teks footer | `Yayasan Pendidikan` | perlu konfirmasi backend | Lihat variabel global. |
| `$unitPendidikan` | string | teks footer | `SMK Nusantara & MI Internasional` | perlu konfirmasi backend | Lihat variabel global. |
| `$tahunAjaran` | string | badge tahun ajaran | `2026/2027` | dipakai | Lihat variabel global. |
| `$versi` | string | footer versi | `2.4.0` | perlu konfirmasi backend | Lihat variabel global. |

### Jurnal Sikap & P5

View: `wali-murid/jurnal-sikap.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$siswa` | object | `nama`, `inisial`, `nis`, `nisn`, `kelas`, `sekolah` | Lihat variabel global | perlu konfirmasi backend | Dipakai pada kartu siswa dan dokumen cetak. |
| `$waliKelas` | object | `nama`, `nip` | Lihat variabel global | perlu konfirmasi backend | Nama pada verifikasi/tanda tangan; NIP pada dokumen. |
| `$profilWali` | object | `nama` | `{nama: "Nama Wali"}` | perlu konfirmasi backend | Nama penanda tangan orang tua/wali. |
| `$dimensiP5` | array/collection JSON-serializable | `nama`, `predikat`, `tgl`, `status`, `cetakStatus`, `teks`, `deskripsi`, `svg`, `warna.garis`, `warna.ikon`, `warna.lencana`, `warna.titik`, `warna.kotak`, `warna.status` | `[{nama: "Mandiri", predikat: "Baik (B)", tgl: "20 Okt 2026", status: "Terverifikasi", cetakStatus: "Terverifikasi sekolah", teks: "Deskripsi singkat", deskripsi: "Deskripsi terformat", svg: "<path ...>", warna: {garis: "border-l-blue-500", ikon: "bg-blue-50 text-blue-600", lencana: "border-blue-200 bg-blue-50 text-blue-700", titik: "bg-blue-500", kotak: "border-slate-100 bg-slate-50/70", status: "bg-emerald-50 text-emerald-700"}}]` | perlu konfirmasi backend | Disematkan dengan `@json`; `svg` dan `deskripsi` dirender memakai `x-html`, jadi wajib berasal dari data tepercaya/terkontrol. Field kelas warna harus mengikuti style view yang ada. |
| `$semester` | string | semester laporan | `Ganjil` | perlu konfirmasi backend | Dipakai bersama tahun ajaran pada kartu dan dokumen. |
| `$tahunAjaran` | string | badge dan judul dokumen | `2026/2027` | dipakai | Lihat variabel global. |
| `$namaYayasan` | string | kop/footer | `Yayasan Pendidikan` | perlu konfirmasi backend | Lihat variabel global. |
| `$namaSekolah` | string | kop dokumen | `SMK Nusantara` | perlu konfirmasi backend | Identitas sekolah. |
| `$alamatSekolah` | string | alamat kop dokumen | `Alamat sekolah` | perlu konfirmasi backend | Teks siap tampil. |
| `$akreditasiSekolah` | string | nilai akreditasi | `A` | perlu konfirmasi backend | Fallback `-`. |
| `$lokasiSekolah` | string | lokasi tanggal cetak | `Wonosobo` | perlu konfirmasi backend | Fallback `-`. |
| `$versi` | string | footer versi dokumen | `2.4.0` | perlu konfirmasi backend | Lihat variabel global. |

### Tagihan & Pembayaran

View: `wali-murid/tagihan-pembayaran.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$siswa` | object | `nama`, `inisial`, `nis`, `kelas`, `sekolah` | Lihat variabel global | perlu konfirmasi backend | Identitas siswa di kartu dan kuitansi. |
| `$ringkasanKeuangan` | object | `statusAdministrasi`, `statusSpp`, `periodeSpp`, `pesanStatusSpp`, `periodeBerikutnya`, `jatuhTempo`, `totalTagihanLainnya`, `pesanTagihanLainnya`, `biayaTambahanSemester`, `statusVerifikasi` | Lihat variabel global | perlu konfirmasi backend | Jumlah tagihan berupa angka; tanggal/periode dikirim sebagai teks siap tampil. |
| `$tahunTransaksiOptions` | array/collection | string label tahun | `["Tahun 2026", "Tahun 2025"]` | perlu konfirmasi backend | Mengisi filter transaksi. |
| `$tahunTransaksiTerpilih` | string | tahun aktif pada filter Alpine | `Tahun 2026` | perlu konfirmasi backend | Harus cocok dengan key `$transaksiTahunan`; fallback string kosong. |
| `$transaksiTahunan` | object/array JSON-serializable | key label tahun; baris `tgl`, `kode`, `uraian`, `nominal`, `status` | `{"Tahun 2026": [{"tgl": "25 Okt 2026", "kode": "TRX-001", "uraian": "SPP Bulan Oktober", "nominal": 250000, "status": "Lunas"}]}` | perlu konfirmasi backend | `nominal` angka; status `Lunas` memakai badge hijau, status lain memakai merah. Data juga menjadi sumber unduhan kuitansi lokal. |
| `$namaYayasan` | string | teks institusi dan kuitansi | `Yayasan Pendidikan` | perlu konfirmasi backend | Lihat variabel global. |
| `$namaSekolah` | string | kuitansi | `SMK Nusantara` | perlu konfirmasi backend | Nama sekolah pada kuitansi. |
| `$kontakTu` | object | `telepon`, `jamOperasional` | `{telepon: "081234567890", jamOperasional: "Senin-Sabtu (07:30 - 14:00 WIB)"}` | perlu konfirmasi backend | Informasi loket; tautan WhatsApp saat ini masih `#`. |
| `$unitPendidikan` | string | teks footer | `SMK Nusantara & MI Internasional` | perlu konfirmasi backend | Lihat variabel global. |
| `$perihalPesanOptions` | array/collection | string perihal | `["Konfirmasi pembayaran SPP", "Kuitansi belum diterima"]` | perlu konfirmasi backend | Opsi kosong “Pilih perihal...” tetap dipertahankan. |
| `$semester` | string | semester pada kartu siswa | `Ganjil` | perlu konfirmasi backend | Lihat kontrak KBM/P5. |
| `$tahunAjaran` | string | badge dan kartu siswa | `2026/2027` | dipakai | Lihat variabel global. |
| `$versi` | string | footer versi | `2.4.0` | perlu konfirmasi backend | Lihat variabel global. |

### Profil Akun

View: `wali-murid/profil-pengguna.blade.php`

| Variabel | Tipe | Field yang dipakai view | Contoh nilai | Status | Catatan |
|---|---|---|---|---|---|
| `$profilWali` | object/array JSON-serializable | `nama`, `inisial`, `hubungan`, `email`, `telepon`, `alamat`, `diperbarui` | `{nama: "Nama Wali", inisial: "NW", hubungan: "Orang Tua", email: "wali@example.test", telepon: "081234567890", alamat: "Alamat rumah", diperbarui: "25 Oktober 2026"}` | perlu konfirmasi backend | Menjadi data kartu, nilai hubungan, dan model Alpine. Form sandi tidak disimpan dalam objek. |
| `$statusVerifikasiAkun` | string | badge verifikasi | `Akun Terverifikasi` | perlu konfirmasi backend | Label status siap tampil. |
| `$siswa` | object | `nama`, `kelas` | Lihat variabel global | perlu konfirmasi backend | Dipakai pada keterangan hubungan wali dengan siswa. |
| `$tahunAjaran` | string | badge tahun ajaran | `2026/2027` | dipakai | Lihat variabel global. |
| `$namaYayasan` | string | footer institusi | `Yayasan Pendidikan` | perlu konfirmasi backend | Lihat variabel global. |
| `$unitPendidikan` | string | teks footer | `SMK Nusantara & MI Internasional` | perlu konfirmasi backend | Lihat variabel global. |
| `$versi` | string | footer versi | `2.4.0` | perlu konfirmasi backend | Lihat variabel global. |

### Form & Aksi

Form, `action`, `method`, `@csrf`, dan handler Alpine tidak diubah. Daftar berikut mencatat kebutuhan tampilan untuk tahap backend.

| Halaman | Form/tombol | Action atau handler saat ini | Kebutuhan route dari sisi tampilan | Catatan |
|---|---|---|---|---|
| Beranda Utama | Hubungi via WhatsApp | `href="#"` | Tautan eksternal WhatsApp wali kelas | Nomor tujuan perlu dikonfirmasi; bukan route aplikasi. |
| Rapor Akademik | Unduh Rapor / Simpan sebagai PDF | Handler Alpine dan `window.print()` | Tidak perlu route untuk cetak lokal saat ini | Dipertahankan. |
| Jurnal KBM Mingguan | Beri Tanggapan | Form `POST` ke `#`, `@csrf`, `@submit.prevent="kirimTanggapan()"` | POST untuk menyimpan tanggapan jurnal | Saat ini handler hanya mengubah state lokal dan menampilkan notifikasi. |
| Jurnal KBM Mingguan | Ajukan Sanggahan | Form `POST` ke `#`, `@csrf`, `multipart/form-data`, `@submit.prevent="kirimSanggahan()"` | POST untuk menyimpan sanggahan/koreksi dan berkas bukti opsional | Saat ini handler hanya mengubah state lokal. |
| Jurnal Sikap & P5 | Unduh Jurnal / Simpan sebagai PDF | Handler Alpine dan `window.print()` | Tidak perlu route untuk cetak lokal saat ini | Dipertahankan. |
| Tagihan & Pembayaran | Kirim Pesan ke TU | Form `POST` ke `#`, `@csrf`, `@submit.prevent="kirim()"` | POST pesan/perihal wali murid kepada Tata Usaha | Saat ini hanya simulasi lokal; tautan WhatsApp juga masih `#`. |
| Tagihan & Pembayaran | Unduh Kuitansi | Membuat berkas teks di browser | Tidak perlu route untuk unduhan lokal saat ini | Jika kuitansi resmi PDF diperlukan, endpoint perlu disepakati terpisah. |
| Profil Akun | Simpan Perubahan | Form `POST` ke `#`, `@csrf`, `@submit.prevent="simpanProfil()"` | PUT/PATCH untuk memperbarui profil wali | Saat ini hanya simulasi lokal. |
| Profil Akun | Perbarui Sandi | Form `POST` ke `#`, `@csrf`, `@submit.prevent="simpanSandi()"` | POST/PATCH untuk perubahan sandi | Saat ini hanya simulasi lokal. |
| Layout Wali Murid | Keluar / Logout | Form logout pada partial sidebar | Tidak ada perubahan | Partial sidebar dan `@csrf` dipertahankan. |
