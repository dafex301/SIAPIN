<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->insert([
      [
        'nama' => 'admin',
        'nim' => '123',
        'email' => 'admin@undip.co.id',
        'password' => bcrypt('admin')
      ],
      [
        'nama' => 'Fahrel',
        'nim' => '24060120130106',
        'email' => 'fahrel@students.undip.ac.id',
        'password' => bcrypt('fahrel')
      ],
      [
        'nama' => 'Gibran',
        'nim' => '24060120130107',
        'email' => 'Gibran@students.undip.ac.id',
        'password' => bcrypt('gibran')
      ],
      [
        'nama' => 'Alghany',
        'nim' => '24060120130108',
        'email' => 'Alghany@students.undip.ac.id',
        'password' => bcrypt('alghany')
      ],
      [
        'nama' => 'Luffy',
        'nim' => '24060120130109',
        'email' => 'luffy@students.undip.ac.id',
        'password' => bcrypt('luffy')
      ],
      [
        'nama' => 'zoro',
        'nim' => '24060120130110',
        'email' => 'zoro@students.undip.ac.id',
        'password' => bcrypt('zoro')
      ],
      [
        'nama' => 'sanji',
        'nim' => '24060120130111',
        'email' => 'sanji@students.undip.ac.id',
        'password' => bcrypt('sanji')
      ],
    ]);
  }
}
