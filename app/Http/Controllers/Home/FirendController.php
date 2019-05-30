<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class FirendController extends Controller
{
    public function index()
    {
    	return view('home/firend',['title' => '友情申请']);
    }


    public function tianjia(Request $request)
    {
    	$rs = $request->only(['fname','furl']);
    	$rs['faddtime'] = time();
    	$rs['status'] = 0;
    	
    	$data = DB::table('firend')->insert($rs);

    	if($data){
    		return redirect('/');
    	}
    	
    }
}
