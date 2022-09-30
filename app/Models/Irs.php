<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Irs extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'jadwal_id'
  ];

  // Every 1 IRS have 1 user
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  // Every 1 irs have 1 jadwal
  public function jadwal()
  {
    return $this->belongsTo(Jadwal::class);
  }
}
