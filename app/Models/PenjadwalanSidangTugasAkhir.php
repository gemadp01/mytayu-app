<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjadwalanSidangTugasAkhir extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pengajuansidangta() {
        return $this->belongsTo(PengajuanSidangTugasAkhir::class, 'pengajuan_sidang_tugas_akhir_id');
    }

    public function pengujiutama() {
        return $this->belongsTo(Dosen::class, 'penguji_utama_id');
    }

    public function uji1() {
        return $this->belongsTo(Dosen::class, 'uji1_id');
    }

    public function uji2() {
        return $this->belongsTo(Dosen::class, 'uji2_id');
    }

    public function uji3() {
        return $this->belongsTo(Dosen::class, 'uji3_id');
    }

    public function penilaiansidangta() {
        return $this->hasOne(PenilaianSidangTugasAkhir::class);
    }
}
