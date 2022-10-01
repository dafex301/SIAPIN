<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qr extends Model
{
  use HasFactory;

  // Fillable jadwal_id and pertemuan
  protected $fillable = [
    'jadwal_id',
    'pertemuan',
    'qr_code'
  ];

  // For every qr could have one jadwal
  public function jadwal()
  {
    return $this->belongsTo(Jadwal::class);
  }
}
