<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
          //
     /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'goods';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];

      public function gm()
    {
    	return $this->hasMany('App\Model\Admin\img','gid','id');
    }
}
