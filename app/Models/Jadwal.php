<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
  use HasFactory;

  // Fillable jadwal
  protected $fillable = [
    'nama',
    'lab_id',
    'matkul_id',
    'asprak_1',
    'asprak_2',
    'hari',
    'jam_mulai',
    'jam_selesai'
  ];

  // Relationship with Lab
  public function lab()
  {
    return $this->belongsTo(Lab::class);
  }

  // Relationship with Matkul
  public function matkul()
  {
    return $this->belongsTo(Matkul::class);
  }

  // Relationship with User
  public function asprak1()
  {
    return $this->belongsTo(User::class, 'asprak_1');
  }

  // Relationship with User
  public function asprak2()
  {
    return $this->belongsTo(User::class, 'asprak_2');
  }
}
