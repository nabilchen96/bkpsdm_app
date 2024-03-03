<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupInstrumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grup_instrumens', function (Blueprint $table) {
            $table->id();
            $table->string('nama_grup_instrumen')->nullable();
            $table->unsignedBigInteger('user_input')->nullable();
            $table->timestamps();

            $table->foreign('user_input')->references('id')->on('users')
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
        Schema::dropIfExists('grup_instrumens');
    }
}
