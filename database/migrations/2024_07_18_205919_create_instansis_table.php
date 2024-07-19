<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstansisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instansis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_instansi')->nullable();
            $table->string('nama_lembaga')->nullable();
            $table->string('status')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nama_kepala')->nullable();
            $table->string('nip')->nullable();
            $table->string('email')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('instansis');
    }
}
