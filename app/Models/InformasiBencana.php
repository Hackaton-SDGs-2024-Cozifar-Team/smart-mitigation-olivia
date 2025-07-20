<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiBencana extends Model
{
    protected $table = 'informasi_bencanas';
    protected $guarded = [];
    protected $primaryKey = 'id_informasi_bencana';


    public function laporanBencana()
    {
        return $this->belongsTo(LaporanBencana::class, 'id_laporan_bencana');
    }
}
