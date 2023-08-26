<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSeminarTugasAkhir extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $with = ['user'];

    protected $casts = [
        'sertifikat_kegiatan' => 'json', // atau 'array'
        // ...
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function detailpengajuanseminarta() {
        return $this->hasOne(DetailPengajuanSeminarTugasAkhir::class);
    }

    public function penjadwalanseminarta() {
        return $this->hasOne(PenjadwalanSeminarTugasAkhir::class);
    }

    public function penilaianseminarta() {
        return $this->hasOne(PenilaianSeminarTugasAkhir::class);
    }
}
