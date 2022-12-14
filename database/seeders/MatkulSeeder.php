<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MatkulSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('matkuls')->insert([
      [
        'kode_matkul' => 'IF-401',
        'nama_matkul' => 'Pemrograman Web',
        'pertemuan' => 6
      ],
      [
        'kode_matkul' => 'IF-402',
        'nama_matkul' => 'Pemrograman Mobile',
        'pertemuan' => 12
      ],
      [
        'kode_matkul' => 'IF-403',
        'nama_matkul' => 'Pemrograman Desktop',
        'pertemuan' => 12
      ],
      [
        'kode_matkul' => 'IF-404',
        'nama_matkul' => 'Pemrograman Berbasis Kerangka Kerja',
        'pertemuan' => 12
      ],
      [
        'kode_matkul' => 'IF-405',
        'nama_matkul' => 'Pemrograman Berbasis Komponen',
        'pertemuan' => 12
      ],
      [
        'kode_matkul' => 'IF-406',
        'nama_matkul' => 'Pemrograman Berbasis Layanan',
        'pertemuan' => 12
      ],
      [
        'kode_matkul' => 'IF-407',
        'nama_matkul' => 'Pemrograman Berbasis Perangkat Bergerak',
        'pertemuan' => 12
      ],
      [
        'kode_matkul' => 'IF-408',
        'nama_matkul' => 'Pemrograman Berbasis Perangkat Lunak',
        'pertemuan' => 12
      ],
      [
        'kode_matkul' => 'IF-409',
        'nama_matkul' => 'Pemrograman Berbasis Web',
        'pertemuan' => 12
      ],
      [
        'kode_matkul' => 'IF-410',
        'nama_matkul' => 'Pemrograman Berbasis Web Dinamis',
        'pertemuan' => 12
      ],
      [
        'kode_matkul' => 'IF-411',
        'nama_matkul' => 'Pemrograman Berbasis Web Statik',
        'pertemuan' => 12
      ],
      [
        'kode_matkul' => 'IF-412',
        'nama_matkul' => 'Pemrograman Berbasis Web Terdistribusi',
        'pertemuan' => 12
      ]

    ]);
  }
}
