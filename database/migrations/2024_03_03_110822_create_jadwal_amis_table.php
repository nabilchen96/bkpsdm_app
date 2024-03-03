<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalAmisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_amis', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->string('priode',10)->nullable();
            $table->string('prodi')->nullable();
            $table->date('tgl_awal_upload')->nullable();
            $table->date('tgl_akhir_upload')->nullable();
            $table->bigInteger('auditor_satu')->nullable();
            $table->bigInteger('auditor_dua')->nullable();
            $table->bigInteger('auditor_tiga')->nullable();
            $table->unsignedBigInteger('input_oleh')->nullable();
            $table->unsignedBigInteger('kurikulum_instrumen_id')->nullable();
            $table->enum('status_aktif',['0','1'])->default('1');

            $table->foreign('input_oleh')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('kurikulum_instrumen_id')->references('id')->on('kurikulum_instrumens')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
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
        Schema::dropIfExists('jadwal_amis');
    }
}
