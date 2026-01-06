<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Fakultas Master Table
        Schema::create('jdw_fakultas', function (Blueprint $table) {
            $table->string('api_id', 10)->primary();
            $table->string('nama', 100);
            $table->string('singkatan', 10)->nullable();
            $table->timestamps();
        });

        // 2. Prodi Master Table
        Schema::create('jdw_prodi', function (Blueprint $table) {
            $table->string('api_id', 50)->primary();
            $table->string('nama');
            $table->string('singkatan', 10)->nullable();
            $table->string('jenjang', 10)->nullable();
            $table->string('fakultas_id', 10);
            $table->timestamps();

            $table->foreign('fakultas_id')
                ->references('api_id')
                ->on('jdw_fakultas')
                ->onDelete('cascade');
        });

        // 3. Mata Kuliah Master Table
        Schema::create('jdw_mata_kuliah', function (Blueprint $table) {
            $table->string('kode', 20)->primary();
            $table->string('nama');
            $table->unsignedTinyInteger('sks')->default(0);
            $table->timestamps();
        });

        // 4. Jadwal Transactional Table
        Schema::create('jdw_jadwal', function (Blueprint $table) {
            $table->id();
            $table->string('mata_kuliah_kode', 20);
            $table->string('prodi_id', 50);
            $table->string('kelas_nama', 10);
            $table->string('kelas_status', 5)->default('y');
            $table->string('dosen')->nullable();
            $table->string('hari', 20);
            $table->string('jam', 255);
            $table->string('ruangan', 50)->nullable();
            $table->string('smt_id', 10)->nullable();
            
            // Gabung/merge class info
            $table->string('gabung_kelas_nama', 10)->nullable();
            $table->string('gabung_mata_kuliah_kode', 20)->nullable();
            $table->string('gabung_mata_kuliah_nama')->nullable();
            $table->unsignedTinyInteger('gabung_mata_kuliah_sks')->nullable();
            
            $table->timestamp('synced_at')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('mata_kuliah_kode')
                ->references('kode')
                ->on('jdw_mata_kuliah')
                ->onDelete('cascade');
            
            $table->foreign('prodi_id')
                ->references('api_id')
                ->on('jdw_prodi')
                ->onDelete('cascade');

            // Indexes
            $table->index('hari', 'jadwal_hari_idx');
            $table->index('smt_id', 'jadwal_smt_idx');
            $table->index('dosen', 'jadwal_dosen_idx');
        });

        // API Sync Logs
        if (!Schema::hasTable('api_sync_logs')) {
            Schema::create('api_sync_logs', function (Blueprint $table) {
                $table->id();
                $table->string('type', 50);
                $table->unsignedInteger('records_synced')->default(0);
                $table->enum('status', ['success', 'failed'])->default('success');
                $table->text('error_message')->nullable();
                $table->timestamp('synced_at');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('jdw_jadwal');
        Schema::dropIfExists('jdw_mata_kuliah');
        Schema::dropIfExists('jdw_prodi');
        Schema::dropIfExists('jdw_fakultas');
        Schema::dropIfExists('api_sync_logs');
    }
};
