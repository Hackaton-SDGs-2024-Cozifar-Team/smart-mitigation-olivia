<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClusteringBencana extends Model
{
    protected $table = 'clustering_bencanas';
    protected $guarded = ['id_clustering_bencana'];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }
    protected $primaryKey = 'id_clustering_bencana';

}
