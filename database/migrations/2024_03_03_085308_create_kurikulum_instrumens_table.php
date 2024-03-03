<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKurikulumInstrumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kurikulum_instrumens', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kurikulum')->nullable();
            $table->enum('is_aktif',['0','1'])->default('1');
            $table->unsignedBigInteger('input_oleh')->nullable();

            $table->foreign('input_oleh')->references('id')->on('users')
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
        Schema::dropIfExists('kurikulum_instrumens');
    }
}
