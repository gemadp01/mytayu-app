<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSidangTugasAkhir extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function detailpengajuansidangta() {
        return $this->hasOne(DetailPengajuanSidangTugasAkhir::class);
    }

    public function penjadwalansidangta() {
        return $this->hasOne(PenjadwalanSidangTugasAkhir::class);
    }
}
