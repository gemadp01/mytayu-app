<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function appointment() {
        return $this->belongsTo(Appointment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
