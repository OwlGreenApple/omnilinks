<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
          DB::table('users')->insert([
            'name'=>'Puspitasari N',
            'email'=>'puspita.celebgramme@gmail.com',
            'username'=>'puspitaa',
            'password'=>bcrypt('clbapril2018'),
            'gender'=>0, //female
            'point'=>0,
            'membership' => "elite",
            'is_admin'=>1,//admin
            'is_confirm'=>1,
            'confirm_code'=>null,
            'last_login'=>null,
            'referral_link'=>null,
            'remember_token'=>null,
          ]);

          DB::table('users')->insert([
            'name'=>'Nissa Restiyana',
            'email'=>'it.axiapro@gmail.com',
            'username'=>'Nissa',
            'password'=>bcrypt('nissaadminclb'),
            'gender'=>0, //female
            'point'=>0,
            'membership' => "elite",
            'is_admin'=>1,//admin
            'is_confirm'=>1,
            'confirm_code'=>null,
            'last_login'=>null,
            'referral_link'=>null,
            'remember_token'=>null,
          ]);

          DB::table('users')->insert([
            'name'=>'Ira Kurniasari',
            'email'=>'ira.celebgramme@gmail.com',
            'username'=>'Ira',
            'password'=>bcrypt('iraadminclb'),
            'gender'=>0, //female
            'point'=>0,
            'membership' => "elite",
            'is_admin'=>1,//admin
            'is_confirm'=>1,
            'confirm_code'=>null,
            'last_login'=>null,
            'referral_link'=>null,
            'remember_token'=>null,
          ]);
    }
}
