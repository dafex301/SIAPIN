<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JadwalSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('jadwals')->insert([
      [
        'nama' => 'Pemrograman Web A1',
        'lab_id' => 1,
        'matkul_id' => 1,
        'asprak_1' => 2,
        'asprak_2' => 3,
        'hari' => 'Senin',
        'jam_mulai' => '08:00:00',
        'jam_selesai' => '10:00:00',
      ],
      [
        'nama' => 'Pemrograman Mobile A2',
        'lab_id' => 2,
        'matkul_id' => 2,
        'asprak_1' => 3,
        'asprak_2' => 4,
        'hari' => 'Selasa',
        'jam_mulai' => '08:00:00',
        'jam_selesai' => '10:00:00',
      ],
      [
        'nama' => 'Pemrograman Desktop A1',
        'lab_id' => 3,
        'matkul_id' => 3,
        'asprak_1' => 5,
        'asprak_2' => 6,
        'hari' => 'Rabu',
        'jam_mulai' => '08:00:00',
        'jam_selesai' => '10:00:00',
      ],
    ]);
  }
}
