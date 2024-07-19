<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnToInstansisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instansis', function (Blueprint $table) {
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();

            //kepala badan
            $table->string('nama_kepala_badan')->nullable();
            $table->string('nip_kepala_badan')->nullable();
            $table->string('pangkat_kepala_badan')->nullable();

            //kepala bidang
            $table->string('nama_kepala_bidang')->nullable();
            $table->string('nip_kepala_bidang')->nullable();
            $table->string('pangkat_kepala_bidang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instansis', function (Blueprint $table) {
            //
        });
    }
}
