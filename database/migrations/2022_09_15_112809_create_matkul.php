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
    Schema::create('matkul', function (Blueprint $table) {
      $table->id();
      $table->string('kode_matkul', 10);
      $table->string('nama_matkul', 100);
      $table->integer('pertemuan');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('matkul');
  }
};