<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanTugasAkhir extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function usulanDospemPertama() {
        return $this->belongsTo(Dosen::class, 'usulan_pembimbing_mhs1_id');
    }

    public function usulanDospemKedua() {
        return $this->belongsTo(Dosen::class, 'usulan_pembimbing_mhs2_id');
    }
}
