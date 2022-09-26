<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
  use HasFactory;

  // Fillable kode_matkul
  protected $fillable = [
    'kode_matkul',
    'nama_matkul',
    'pertemuan'
  ];

  // Relationship with jadwal
  public function jadwal()
  {
    return $this->hasMany(Jadwal::class);
  }
}
