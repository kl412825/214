<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Discuss extends Model
{
     //
    protected $table = 'discuss';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];
}
