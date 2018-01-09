<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (class_exists(DevelopDataSeeder::class)){
            // 开发调试数据，不加入git
            $this->call(DevelopDataSeeder::class);
        }else{
            $this->call(UserTableSeeder::class);
            $this->call(MonitorTableSeeder::class);
        }
    }
}
