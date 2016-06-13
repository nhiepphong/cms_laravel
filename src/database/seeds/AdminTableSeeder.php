<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Nhiepphong\Backend\Seeder;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder{
    
    public function run(){
        
        DB::table('admin_user')->delete();
        
        DB::table('admin_user')->insert(
              array('username'=>'admin',
                   'group_id'=>'1',
                   'password'=>'2813ba16cd7d0b1e73f201f91393c5a1',
                   'fullname'=>'Administrator',
                   'permissions'=>'',
                   'created'=>'2010-07-17 00:23:41',
                   'modified'=>'2010-07-17 00:23:41',
                   'is_active'=>'1')
        );
    }
    
}