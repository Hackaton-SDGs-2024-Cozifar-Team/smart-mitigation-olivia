<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KebutuhanKorban extends Model
{
    protected $table = 'kebutuhan_korbans';
    protected $primaryKey = 'id_kebutuhan_korban';
    protected $guarded = ['id_kebutuhan_korban'];
}
