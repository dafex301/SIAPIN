<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
  use HasFactory;

  // Fillable lab
  protected $fillable = [
    'nama',
    'lantai',
    'gedung',
    'kapasitas'
  ];
}
