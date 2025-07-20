<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    protected $table = 'distribusis';
    protected $primaryKey = 'id_distribusi';
    protected $guarded = ['id_distribusi'];

    public function posko()
    {
        return $this->belongsTo(Posko::class, 'id_posko', 'id_posko');
    }
}
