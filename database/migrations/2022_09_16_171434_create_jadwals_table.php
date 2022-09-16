<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lab_id');
            $table->unsignedBigInteger('matkul_id')->unique();
            $table->time('start');
            $table->time('end');
            $table->timestamps();

            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
            $table->foreign('matkul_id')->references('id')->on('matkuls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwals');
    }
};
