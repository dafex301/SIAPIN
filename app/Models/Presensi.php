<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
  use HasFactory;

  // Fillable irs_id and pertemuan
  protected $fillable = [
    'irs_id',
    'pertemuan'
  ];

  // For every presensi could have one IRS
  public function irs()
  {
    return $this->belongsTo(Irs::class);
  }
}
