<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianSidangTugasAkhir extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pengajuansidangta() {
        return $this->belongsTo(PengajuanSidangTugasAkhir::class, 'pengajuan_sidangta_id');
    }

    public function penjadwalansidangta() {
        return $this->belongsTo(PenjadwalanSidangTugasAkhir::class, 'penjadwalan_sidangta_id');
    }

    public function pengujiutama() {
        return $this->belongsTo(Dosen::class, 'penguji_utama_id');
    }

    public function penguji1() {
        return $this->belongsTo(Dosen::class, 'penguji1_id');
    }

    public function penguji2() {
        return $this->belongsTo(Dosen::class, 'penguji2_id');
    }

    public function penguji3() {
        return $this->belongsTo(Dosen::class, 'penguji3_id');
    }
}
