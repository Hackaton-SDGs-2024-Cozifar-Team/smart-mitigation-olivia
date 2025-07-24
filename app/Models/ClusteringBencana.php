<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ClusteringBencana extends Model
{
    use HasFactory;

    protected $table = 'clustering_bencanas';
    protected $guarded = ['id_clustering_bencana'];

    protected $fillable = [
        'id_desa',
        'cluster'
    ];

    protected static function boot()
    {
        parent::boot();

        // Clear cache when data changes
        static::saved(function () {
            Cache::forget('clustering_bencana_data');
        });

        static::deleted(function () {
            Cache::forget('clustering_bencana_data');
        });
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa', 'id_desa');
    }
    protected $primaryKey = 'id_clustering_bencana';

}
