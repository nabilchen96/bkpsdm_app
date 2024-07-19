<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianDinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_dinas', function (Blueprint $table) {
            $table->id();
            $table->string('id_pegawai');
            $table->string('pangkat_golongan')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('instansi')->nullable();
            $table->string('jenis_ujian')->nullable();
            $table->string('file')->nullable();
            $table->string('foto')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ujian_dinas');
    }
}
