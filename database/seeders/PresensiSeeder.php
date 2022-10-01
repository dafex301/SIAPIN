<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PresensiSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('presensis')->insert([
      // [
      //   'irs_id' => 1,
      //   'pertemuan' => 1,
      // ],
      // [
      //   'irs_id' => 1,
      //   'pertemuan' => 2,
      // ],
      // [
      //   'irs_id' => 2,
      //   'pertemuan' => 1,
      // ],
    ]);
  }
}
