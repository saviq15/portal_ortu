<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WaliMuridLayoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_wali_murid_pages_render_the_shared_layout_and_active_menu(): void
    {
        $user = User::create([
            'name' => 'Bapak Mahmud',
            'username' => 'bapak-mahmud',
            'email' => 'mahmud@example.com',
            'password' => 'password',
            'role' => 'orang_tua',
        ]);

        foreach ([
            'wali.dashboard',
            'wali.rapor-akademik',
            'wali.kbm-mingguan',
            'wali.jurnal-sikap',
            'wali.tagihan-pembayaran',
            'wali.profil-pengguna',
        ] as $routeName) {
            $response = $this->actingAs($user)->get(route($routeName));

            $response->assertOk()
                ->assertSee('SIAKAD Panel')
                ->assertSee('Bapak Mahmud')
                ->assertSee('BM')
                ->assertSee('Orang Tua')
                ->assertSee('Logo SIAKAD')
                ->assertSee('wali-menu-item is-active', false);

            $this->assertSame(
                1,
                substr_count($response->getContent(), 'wali-menu-item is-active')
            );
        }
    }

    public function test_print_previews_remain_available_outside_the_main_shell(): void
    {
        $user = User::create([
            'name' => 'Bapak Mahmud',
            'username' => 'bapak-mahmud',
            'email' => 'mahmud@example.com',
            'password' => 'password',
            'role' => 'orang_tua',
        ]);

        foreach ([
            'wali.rapor-akademik' => "view === 'rapor'",
            'wali.jurnal-sikap' => "view === 'jurnal'",
        ] as $routeName => $shellVisibility) {
            $response = $this->actingAs($user)->get(route($routeName));

            $response->assertOk()
                ->assertSee($shellVisibility, false)
                ->assertSee("x-show=\"view === 'cetak'\"", false);
        }
    }
}
