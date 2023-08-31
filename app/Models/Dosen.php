<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
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
    
    public function pengajuantugasakhir() {
        return $this->hasMany(PengajuanTugasAkhir::class);
    }

    public function detailpengajuantugasakhir() {
        return $this->hasMany(DetailPengajuanTugasAkhir::class);
    }

    // public function dosenUser()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    public function appointment() {
        return $this->hasMany(Appointment::class);
    }

    public function penjadwalansidangta() {
        return $this->hasMany(PenjadwalanSidangTugasAkhir::class);
    }

    public function penilaiansidangta() {
        return $this->hasMany(PenilaianSidangTugasAkhir::class);
    }
    
}
