<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
     //
    protected $table = 'cart';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];
}
