<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IrsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('irs')->insert([
      [
        'user_id' => 6,
        'jadwal_id' => 1
      ],
      [
        'user_id' => 7,
        'jadwal_id' => 1
      ],
      [
        'user_id' => 5,
        'jadwal_id' => 2
      ],
      [
        'user_id' => 5,
        'jadwal_id' => 1
      ],
      [
        'user_id' => 6,
        'jadwal_id' => 2
      ]
    ]);
  }
}
