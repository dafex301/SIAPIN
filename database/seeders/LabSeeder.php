<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LabSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('labs')->insert(
      [
        [
          'nama' => 'Lab A',
          'gedung' => 'A',
          'lantai' => 3,
          'kapasitas' => 30
        ],
        [
          'nama' => 'Lab B',
          'gedung' => 'E',
          'lantai' => 2,
          'kapasitas' => 40
        ],
        [
          'nama' => 'Lab C',
          'gedung' => 'E',
          'lantai' => 2,
          'kapasitas' => 30
        ]
      ]
    );
  }
}
