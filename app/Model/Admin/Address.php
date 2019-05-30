<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
     //
    protected $table = 'address';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];
}
