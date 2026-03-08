<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void 
    {
        // Membuat tabel mahasiswas sesuai instruksi Modul 2
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->string('nim')->primary(); // NIM sebagai Primary Key [cite: 194]
            $table->string('nama');           // Nama Mahasiswa [cite: 195]
            $table->string('kelas');          // Kelas [cite: 196]
            $table->string('matakuliah');     // Mata Kuliah [cite: 197]
            $table->timestamps();             // Kolom created_at dan updated_at [cite: 198]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};