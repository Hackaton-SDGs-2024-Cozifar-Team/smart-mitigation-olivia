<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LaporanBencana extends Model
{
    protected $table = 'laporan_bencanas';
    protected $primaryKey = 'id_laporan_bencana';

    protected $guarded = ['id_laporan_bencana'];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan', 'id_kecamatan');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa', 'id_desa');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    public function donasis()
    {
        return $this->hasMany(Donasi::class, 'id_laporan_bencana', 'id_laporan_bencana');
    }

    public function penggunaanDonasi()
    {
        return $this->hasMany(PenggunaanDanaDonasi::class, 'id_lapora_bencana', 'id_laporan_bencana');
    }
  
    public function donasi() : HasMany
    {
        return $this->hasMany(Donasi::class, 'id_laporan_bencana', 'id_laporan_bencana');
    }

    public function informasiBencana()
    {
        return $this->hasOne(InformasiBencana::class, 'id_laporan_bencana', 'id_laporan_bencana');
    }
}
