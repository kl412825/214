<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
     protected $table = 'balance';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];
}
