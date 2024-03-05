<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubGrupIdToButirInstrumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('butir_instrumens', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_grup_id')->nullable();

            $table->foreign('sub_grup_id')->references('id')->on('sub_grups')
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
        Schema::table('butir_instrumens', function (Blueprint $table) {
            //
        });
    }
}
