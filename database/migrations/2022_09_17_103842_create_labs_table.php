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
    Schema::create('labs', function (Blueprint $table) {
      $table->id();
      $table->string('nama', 100);
      $table->char('gedung', 1);
      $table->integer('lantai');
      $table->integer('kapasitas');
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
    Schema::dropIfExists('labs');
  }
};
