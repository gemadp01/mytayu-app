<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $with = ['dosen', 'mahasiswa', 'pengajuantugasakhir'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // public function scopeFilter($query, $credentials) {
        
    //     return $query->where('username', $credentials['username'])
    //                 ->orWhere('nomor_induk', $credentials['username']);

    // }

    // public function findForPassport($username) {
    //     return $this->orWhere('username', $username)->orWhere('nip', $username)->first();
    // }

    // public function access() {
    //     return $this->belongsTo(Access::class);
    // }

    public function dosen() {
        return $this->hasOne(Dosen::class);
    }

    public function mahasiswa() {
        return $this->hasOne(Mahasiswa::class);
    }
    
    public function pengajuantugasakhir() {
        return $this->hasMany(PengajuanTugasAkhir::class);
    }
}
