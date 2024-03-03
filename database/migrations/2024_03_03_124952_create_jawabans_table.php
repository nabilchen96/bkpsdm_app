<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawabans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_ami_id')->nullable();
            $table->unsignedBigInteger('butir_instrumen_id')->nullable();
            $table->unsignedBigInteger('grup_instrumen_id')->nullable();
            $table->unsignedBigInteger('kurikulum_instrumen_id')->nullable();
            $table->float('skor')->nullable();
            $table->unsignedBigInteger('create_oleh')->nullable();
            $table->timestamps();

            $table->foreign('jadwal_ami_id')->references('id')->on('jadwal_amis')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('butir_instrumen_id')->references('id')->on('butir_instrumens')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('grup_instrumen_id')->references('id')->on('grup_instrumens')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('kurikulum_instrumen_id')->references('id')->on('kurikulum_instrumens')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('create_oleh')->references('id')->on('users')
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
        Schema::dropIfExists('jawabans');
    }
}
