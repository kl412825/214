<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=0;$i<50;$i++){
        DB::talbe('user')->insert([
        	'uname' => str_random(10),
        	'password' => Hash::make('zch1105@@'),
        	'email'=>str_random(10).'@qq.com',
        	'phone' => '13'.rand(111111111,999999999),
        	'profile' => '/uploads/img_39171558192752.jpg',
        	'uaddtime' => time()

        ]);
    	}

         
    }
}
