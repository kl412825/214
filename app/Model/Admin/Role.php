<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
     protected $table = 'role';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];

    public function role_per()
    {
    	return $this->belongsToMany('App\Model\Admin\Permission','role_per','roleid','perid');
    }
}
