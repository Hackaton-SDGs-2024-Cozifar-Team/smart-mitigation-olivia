<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtikelBencana extends Model
{
    protected $table = 'artikel_bencanas';
    protected $guarded = ['id_artikel_bencana'];
    protected $primaryKey = 'id_artikel_bencana';
    protected $fillable = ['judul_artikel', 'isi_artikel', 'tanggal', 'foto_artikel'];
}
