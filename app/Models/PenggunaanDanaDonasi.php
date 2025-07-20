<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenggunaanDanaDonasi extends Model
{
    protected $table = 'penggunaan_dana_donasis';
    protected $guarded = ['id_penggunaan_dana_donasi'];
    protected $primaryKey = 'id_penggunaan_dana_donasi';

    public function laporan()
    {
        return $this->belongsTo(LaporanBencana::class, 'id_lapora_bencana', 'id_laporan_bencana');
    }

    public function laporanBencana()
    {
        return $this->belongsTo(LaporanBencana::class, 'id_lapora_bencana', 'id_laporan_bencana');
    }
}
