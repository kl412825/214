<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
     protected $table = 'adminuser';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];



    //用户和角色的关联
    
    public function users_role()
    {
    	return $this->belongsToMany('App\Model\Admin\Role','users_role','usersid','roleid');
    }
}
