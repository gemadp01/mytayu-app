<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengajuanTugasAkhir extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected $with = ['pengajuanta'];

    public function pengajuanta() {
        return $this->belongsTo(PengajuanTugasAkhir::class, 'pengajuan_tugas_akhir_id');
    }

    public function usulanDospemKaprodiPertama() {
        return $this->belongsTo(Dosen::class, 'usulan_pembimbing_kaprodi1_id');
    }

    public function usulanDospemKaprodiKedua() {
        return $this->belongsTo(Dosen::class, 'usulan_pembimbing_kaprodi2_id');
    }
}
