<?php

namespace Tests\Feature;

use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminKelasCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_update_and_delete_a_class(): void
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'username' => 'admin-test',
            'email' => 'admin-test@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);
        $waliKelas = User::create([
            'name' => 'Wali Test',
            'username' => 'wali-test',
            'email' => 'wali-test@example.com',
            'password' => 'password',
            'role' => 'wali_kelas',
        ]);
        TahunAjaran::create([
            'year' => '2026/2027',
            'semester' => 'Ganjil',
            'is_active' => true,
        ]);
        Kelas::create([
            'nama_kelas' => 'X TKJ 1',
            'tingkat' => 'X',
            'jurusan' => 'Teknik Komputer dan Jaringan',
            'tahun_ajaran' => '2026/2027',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.kelas.view'))
            ->assertOk()
            ->assertSee('Daftar Rombongan Belajar')
            ->assertSee('name="_token"', false)
            ->assertSee('name="_method" value="PUT"', false);

        $payload = [
            'unit' => 'smk',
            'nama_kelas' => 'X TKJ 2',
            'wali_kelas_id' => $waliKelas->id,
        ];

        $this->actingAs($admin)
            ->post(route('admin.kelas.store'), $payload)
            ->assertRedirect(route('admin.kelas.view'))
            ->assertSessionHas('success');

        $kelas = Kelas::query()->where('nama_kelas', 'X TKJ 2')->firstOrFail();
        $this->assertSame('X', $kelas->tingkat);
        $this->assertSame('Teknik Komputer dan Jaringan', $kelas->jurusan);
        $this->assertSame('2026/2027', $kelas->tahun_ajaran);
        $this->assertDatabaseHas('users', [
            'id' => $waliKelas->id,
            'kelas_id' => $kelas->id,
        ]);

        $this->actingAs($admin)
            ->put(route('admin.kelas.update', ['kela' => $kelas->id]), [
                'unit' => 'mi',
                'nama_kelas' => 'Kelas 2 (Umar)',
                'wali_kelas_id' => $waliKelas->id,
            ])
            ->assertRedirect(route('admin.kelas.view'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('kelas', [
            'id' => $kelas->id,
            'nama_kelas' => 'Kelas 2 (Umar)',
            'tingkat' => '2',
            'jurusan' => null,
            'tahun_ajaran' => '2026/2027',
        ]);

        $this->actingAs($admin)
            ->delete(route('admin.kelas.destroy', ['kela' => $kelas->id]))
            ->assertRedirect(route('admin.kelas.view'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('kelas', ['id' => $kelas->id]);
        $this->assertDatabaseHas('users', [
            'id' => $waliKelas->id,
            'kelas_id' => null,
        ]);
    }

    public function test_class_store_rejects_a_user_who_is_not_a_wali_kelas(): void
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'username' => 'admin-test',
            'email' => 'admin-test@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);
        $guru = User::create([
            'name' => 'Guru Test',
            'username' => 'guru-test',
            'email' => 'guru-test@example.com',
            'password' => 'password',
            'role' => 'guru',
        ]);
        TahunAjaran::create([
            'year' => '2026/2027',
            'semester' => 'Ganjil',
            'is_active' => true,
        ]);

        $this->actingAs($admin)
            ->from(route('admin.kelas.view'))
            ->post(route('admin.kelas.store'), [
                'unit' => 'mi',
                'nama_kelas' => 'Kelas 1',
                'wali_kelas_id' => $guru->id,
            ])
            ->assertRedirect(route('admin.kelas.view'))
            ->assertSessionHasErrors('wali_kelas_id');

        $this->assertDatabaseMissing('kelas', ['nama_kelas' => 'Kelas 1']);
    }

    public function test_class_mutation_routes_remain_restricted_to_admins(): void
    {
        $this->post(route('admin.kelas.store'), [
            'unit' => 'mi',
            'nama_kelas' => 'Kelas 1',
            'wali_kelas_id' => 1,
        ])->assertRedirect(route('login'));

        $guru = User::create([
            'name' => 'Guru Test',
            'username' => 'restricted-guru',
            'email' => 'restricted-guru@example.com',
            'password' => 'password',
            'role' => 'guru',
        ]);

        $this->actingAs($guru)
            ->post(route('admin.kelas.store'), [
                'unit' => 'mi',
                'nama_kelas' => 'Kelas 1',
                'wali_kelas_id' => 1,
            ])
            ->assertRedirect('/guru/dashboard');
    }

    public function test_login_and_logout_routes_remain_available(): void
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'username' => 'auth-admin-test',
            'email' => 'auth-admin-test@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $this->get(route('login'))->assertOk();
        $this->actingAs($admin)
            ->post(route('logout'))
            ->assertRedirect('/');

        $this->assertGuest();
    }
}
