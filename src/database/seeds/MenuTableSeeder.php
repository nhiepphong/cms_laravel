<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Nhiepphong\Backend\Seeder;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder{
    
    public function run(){
        
       	DB::table('admin_menu')->truncate();
        
        DB::table('admin_menu')->insert(
              array('name'=>'Dashboard',
                   'parent_id'=>'0',
                   'model'=>'dashboard',
                   'controller'=>'NULL',
                   'link'=>'dashboard',
                   'p_order'=>'0',
                   'created'=>'2010-07-17 00:23:41',
                   'modified'=>'2010-07-17 00:23:41',
                   'is_active'=>'1')
        );

        DB::table('admin_menu')->insert(
              array('name'=>'Permissions',
                   'parent_id'=>'0',
                   'model'=>'permissions',
                   'controller'=>'PermissionsController',
                   'link'=>'permissions/lists',
                   'p_order'=>'1',
                   'created'=>'2010-07-17 00:23:41',
                   'modified'=>'2010-07-17 00:23:41',
                   'is_active'=>'1')
        );
    }
    
}