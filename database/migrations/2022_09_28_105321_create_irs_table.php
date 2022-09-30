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
    Schema::create('irs', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      // Foreign id of user
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
      // Foreign id of jadwal
      $table->foreignId('jadwal_id')->constrained('jadwals')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('irs');
  }
};
