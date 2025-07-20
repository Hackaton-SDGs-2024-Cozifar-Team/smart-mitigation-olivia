<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrediksiBencana extends Model
{
    protected $table = 'prediksi_bencanas';
    protected $primaryKey = 'id_prediksi_bencana';
    protected $guarded = ['id_prediksi_bencana'];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }
}
