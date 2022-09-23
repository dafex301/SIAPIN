<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsPraktikum extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'jadwal_id',
        'isPresent',
    ];
}
