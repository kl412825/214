<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    //
    protected $table = 'management';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];
    
}
