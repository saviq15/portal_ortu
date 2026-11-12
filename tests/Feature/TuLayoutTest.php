<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TuLayoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_tu_pages_render_the_shared_layout_and_active_menu(): void
    {
        $user = User::create([
            'name' => 'Nur Fina',
            'username' => 'nur-fina',
            'email' => 'nur.fina@example.com',
            'password' => 'password',
            'role' => 'pihak_yayasan',
        ]);

        foreach ([
            'tu.dashboard',
            'tu.transaksi-pembayaran',
            'tu.rekapitulasi-keuangan',
            'tu.profil-pengguna',
        ] as $routeName) {
            $response = $this->actingAs($user)->get(route($routeName));

            $response->assertOk()
                ->assertSee('SIAKAD Panel')
                ->assertSee('Nur Fina')
                ->assertSee('NF')
                ->assertSee('Staf TU')
                ->assertSee('Logo SIAKAD')
                ->assertSee('tu-menu-item is-active', false);

            $this->assertSame(
                1,
                substr_count($response->getContent(), 'tu-menu-item is-active')
            );
        }
    }
}
