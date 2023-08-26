<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianSeminarTugasAkhir extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $with = ['pengajuanseminar', 'penjadwalansta'];

    public function pengajuanseminar() {
        return $this->belongsTo(PengajuanSeminarTugasAkhir::class, 'pengajuan_seminarta_id');
    }

    public function penjadwalansta() {
        return $this->belongsTo(PenjadwalanSeminarTugasAkhir::class, 'penjadwalan_seminarta_id');
    }
}
