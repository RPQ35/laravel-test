<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user-izin', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('kelas');
            $table->string('jenis_izin');
            $table->string('image_path')->nullable(); 
            $table->boolean("aprooval")->default(false);
            $table->timestamps();
        });
    
        // Now alter the `image` column to be LONGBLOB
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user-izin');
    }
};
