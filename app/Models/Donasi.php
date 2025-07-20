<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $table = 'donasis';
    protected $guarded = ['id_donasi'];
    protected $primaryKey = 'id_donasi';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    public function laporan()
    {
        return $this->belongsTo(LaporanBencana::class, 'id_laporan_bencana', 'id_laporan_bencana');
    }

    public function kebutuhan()
    {
        return $this->belongsTo(KebutuhanKorban::class, 'id_kebutuhan_korban', 'id_kebutuhan_korban');
    }

    public function laporanBencana()
    {
        return $this->belongsTo(LaporanBencana::class, 'id_laporan_bencana', 'id_laporan_bencana');
    }
}
