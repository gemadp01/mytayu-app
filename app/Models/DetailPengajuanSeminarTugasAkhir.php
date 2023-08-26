<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengajuanSeminarTugasAkhir extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $with = ['pengajuanseminarta'];

    public function pengajuanseminarta() {
        return $this->belongsTo(PengajuanSeminarTugasAkhir::class, 'pengajuan_seminar_tugas_akhir_id');
    }
}
