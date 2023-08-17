<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $with = ['user'];

    public function toggleStatus()
    {
        $this->status_user = !$this->status_user;
        $this->save();

        // Toggle status user terkait
        if ($this->user) {
            $this->user->status_user = $this->status_user;
            $this->user->save();
        }
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
