<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class discuss extends Model
{
     //
    protected $table = 'discuss';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];
    
}
