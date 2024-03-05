<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubGrupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_grups', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sub_grup')->nullable();
            $table->unsignedBigInteger('grup_instrumen_id')->nullable();
            $table->unsignedBigInteger('insert_by')->nullable();
            $table->timestamps();

            $table->foreign('insert_by')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('grup_instrumen_id')->references('id')->on('grup_instrumens')
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
        Schema::dropIfExists('sub_grups');
    }
}
