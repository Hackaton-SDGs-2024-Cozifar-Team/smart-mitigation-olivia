<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posko extends Model
{
    protected $table = 'poskos';
    protected $primaryKey = 'id_posko';
    protected $guarded = ['id_posko'];

    public function bencana()
    {
        return $this->belongsTo(LaporanBencana::class, 'id_laporan_bencana', 'id_laporan_bencana');
    }
}
