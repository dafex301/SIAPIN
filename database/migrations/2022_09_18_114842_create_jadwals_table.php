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
      $table->timestamps();
      // Lab ID as foreign key
      $table->foreignId('lab_id')->constrained('labs');
      // Matkul ID as foreign key
      $table->foreignId('matkul_id')->constrained('matkuls');
      // NIM Asprak as foreign key
      $table->string('asprak_1');
      $table->foreign('asprak_1')->references('nim')->on('users');
      // NIM Asprak as foreign key and could be nullable
      $table->string('asprak_2')->nullable();
      $table->foreign('asprak_2')->references('nim')->on('users')->nullable();
      // Day and Time
      $table->string('hari', 10);
      $table->time('jam_mulai');
      $table->time('jam_selesai');
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
