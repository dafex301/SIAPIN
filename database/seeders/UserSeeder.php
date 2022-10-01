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
        'nama' => 'Fahrel Gibran Alghany',
        'nim' => '24060120130106',
        'email' => 'fahrel@students.undip.ac.id',
        'password' => bcrypt('fahrel')
      ],
      [
        'nama' => 'Rayhan Ilyas Annabil',
        'nim' => '24060120130107',
        'email' => 'rayhan@students.undip.ac.id',
        'password' => bcrypt('rayhan')
      ],
      [
        'nama' => 'Rifan Fatoni Febrianto',
        'nim' => '24060120130108',
        'email' => 'rifan@students.undip.ac.id',
        'password' => bcrypt('rifan')
      ],
      [
        'nama' => 'Hanan Nurul Zain',
        'nim' => '24060120130109',
        'email' => 'hanan@students.undip.ac.id',
        'password' => bcrypt('hanan')
      ],
      [
        'nama' => 'Fiqih Ikhsan',
        'nim' => '24060120130110',
        'email' => 'fiqih@students.undip.ac.id',
        'password' => bcrypt('fiqih')
      ],
      [
        'nama' => 'Monkey D. Luffy',
        'nim' => '24060120130111',
        'email' => 'luffy@students.undip.ac.id',
        'password' => bcrypt('luffy')
      ],
      [
        'nama' => 'Roronoa Zoro',
        'nim' => '24060120130112',
        'email' => 'zoro@students.undip.ac.id',
        'password' => bcrypt('zoro')
      ],
      [
        'nama' => 'Vinsmoke Sanji',
        'nim' => '24060120130113',
        'email' => 'sanji@students.undip.ac.id',
        'password' => bcrypt('sanji')
      ],
    ]);
  }
}
