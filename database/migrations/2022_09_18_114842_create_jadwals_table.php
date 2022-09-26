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
      $table->string('nama');
      // Lab ID as foreign key
      $table->foreignId('lab_id')->constrained('labs');
      // Matkul ID as foreign key
      $table->foreignId('matkul_id')->constrained('matkuls');
      $table->foreignId('asprak_1')->constrained('users');

      // $table->foreign('asprak_1')->references('id')->on('users');
      // Asprak 2 is foreign key from users table, nullable
      $table->foreignId('asprak_2')->nullable()->constrained('users');

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
