<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PrediksiBencana extends Model
{
    use HasFactory;

    protected $table = 'prediksi_bencanas';
    protected $primaryKey = 'id_prediksi_bencana';
    protected $guarded = ['id_prediksi_bencana'];

    protected static function boot()
    {
        parent::boot();

        // Clear cache when prediction data is modified
        static::created(function () {
            Cache::forget('prediksi_bencana_latest');
        });

        static::updated(function () {
            Cache::forget('prediksi_bencana_latest');
        });

        static::deleted(function () {
            Cache::forget('prediksi_bencana_latest');
        });
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }
}
