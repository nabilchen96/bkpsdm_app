<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateButirInstrumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('butir_instrumens', function (Blueprint $table) {
            $table->id();
            $table->string('kode_instrumen')->nullable();
            $table->text('nama_instrumen')->nullable();
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('insert_by')->nullable();
            $table->unsignedBigInteger('grup_instrumen_id')->nullable();
            $table->unsignedBigInteger('kurikulum_instrumen_id')->nullable();
            $table->timestamps();

            $table->foreign('insert_by')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('grup_instrumen_id')->references('id')->on('grup_instrumens')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('kurikulum_instrumen_id')->references('id')->on('kurikulum_instrumens')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('butir_instrumens');
    }
}
