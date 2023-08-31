<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengajuanSidangTugasAkhir extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pengajuansidangta() {
        return $this->belongsTo(PengajuanSidangTugasAkhir::class, 'pengajuan_sidang_tugas_akhir_id');
    }
}
