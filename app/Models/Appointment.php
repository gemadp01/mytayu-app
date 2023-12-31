<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected $with = ['user', 'dosen'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function dosen() {
        return $this->belongsTo(Dosen::class, 'pembimbing_id');
    }

    public function bimbingan() {
        return $this->hasMany(Bimbingan::class);
    }
}
