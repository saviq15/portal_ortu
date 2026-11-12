<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuruLayoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_guru_pages_render_the_shared_layout_and_active_menu(): void
    {
        $user = User::create([
            'name' => 'Siti Aminah',
            'username' => 'siti-aminah',
            'email' => 'siti.aminah@example.com',
            'password' => 'password',
            'role' => 'wali_kelas',
        ]);

        foreach ([
            'guru.dashboard',
            'guru.jadwal-mengajar',
            'guru.input-nilai',
            'guru.penilaian-sikap',
            'guru.riwayat-jurnal',
            'guru.profil-pengguna',
        ] as $routeName) {
            $response = $this->actingAs($user)->get(route($routeName));

            $response->assertOk()
                ->assertSee('SIAKAD Panel')
                ->assertSee('Siti Aminah')
                ->assertSee('SA')
                ->assertSee('Wali Kelas')
                ->assertSee('Logo SIAKAD')
                ->assertSee('guru-menu-item is-active', false);

            $this->assertSame(
                1,
                substr_count($response->getContent(), 'guru-menu-item is-active')
            );
        }
    }
}
