<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('id_pengguna'); // primary key
            $table->string('username')->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('NIP')->nullable(); // jika NIP tidak selalu diisi
            $table->foreignId('id_jenis_pengguna')->constrained('jenis_pengguna')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
}
