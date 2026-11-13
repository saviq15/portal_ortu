<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            Schema::create('tahun_ajarans_new', function (Blueprint $table) {
                $table->id();
                $table->string('year', 9);
                $table->enum('semester', ['Ganjil', 'Genap']);
                $table->boolean('is_active')->default(false);
                $table->timestamps();
            });

            DB::statement(
                'INSERT INTO tahun_ajarans_new (year, semester, is_active, created_at, updated_at)
                 SELECT year, semester, is_active, created_at, updated_at FROM tahun_ajarans'
            );
            Schema::drop('tahun_ajarans');
            Schema::rename('tahun_ajarans_new', 'tahun_ajarans');

            return;
        }

        Schema::table('tahun_ajarans', function (Blueprint $table) {
            $table->id()->first();
        });
    }

    public function down(): void
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            Schema::create('tahun_ajarans_old', function (Blueprint $table) {
                $table->string('year', 9);
                $table->enum('semester', ['Ganjil', 'Genap']);
                $table->boolean('is_active')->default(false);
                $table->timestamps();
            });

            DB::statement(
                'INSERT INTO tahun_ajarans_old (year, semester, is_active, created_at, updated_at)
                 SELECT year, semester, is_active, created_at, updated_at FROM tahun_ajarans'
            );
            Schema::drop('tahun_ajarans');
            Schema::rename('tahun_ajarans_old', 'tahun_ajarans');

            return;
        }

        Schema::table('tahun_ajarans', function (Blueprint $table) {
            $table->dropPrimary(['id']);
            $table->dropColumn('id');
        });
    }
};
