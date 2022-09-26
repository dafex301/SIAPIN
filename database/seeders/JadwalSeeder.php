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
        'lab_id' => 1,
        'matkul_id' => 1,
        'asprak_1' => '24060120130106',
        'asprak_2' => '24060120130107',
        'hari' => 'Senin',
        'jam_mulai' => '08:00:00',
        'jam_selesai' => '10:00:00',
      ],
      [
        'lab_id' => 2,
        'matkul_id' => 2,
        'asprak_1' => '24060120130108',
        'asprak_2' => '24060120130109',
        'hari' => 'Selasa',
        'jam_mulai' => '08:00:00',
        'jam_selesai' => '10:00:00',
      ],
      [
        'lab_id' => 3,
        'matkul_id' => 3,
        'asprak_1' => '24060120130110',
        'asprak_2' => '24060120130111',
        'hari' => 'Rabu',
        'jam_mulai' => '08:00:00',
        'jam_selesai' => '10:00:00',
      ],
    ]);
  }
}
