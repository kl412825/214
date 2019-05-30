<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
       protected $table = 'user';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];
}
