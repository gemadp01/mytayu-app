<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjadwalanSeminarTugasAkhir extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $with = ['pengajuansta'];

    public function pengajuansta() {
        return $this->belongsTo(PengajuanSeminarTugasAkhir::class, 'pengajuan_seminarta_id');
    }

    public function penilaianseminarta() {
        return $this->hasOne(PenilaianSeminarTugasAkhir::class);
    }

}
