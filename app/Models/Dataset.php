<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    protected $table = 'datasets';
    protected $guarded = ['id_dataset'];
    protected $primaryKey = 'id_dataset';
}
