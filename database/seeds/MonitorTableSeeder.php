<?php

use Illuminate\Database\Seeder;

class MonitorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        try{
            $testUser = \App\User::whereName('test')->firstOrFail();
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            $this->command->error("Test User Not Found !");
            return;
        }

        $monitorBaiDu = new \App\Monitor;

        $monitorBaiDu->user_id = $testUser->id;

        $monitorBaiDu->title = \App\Monitor::generateTitle();
        $monitorBaiDu->request_url = "https://www.baidu.com";
        $monitorBaiDu->request_method = "GET";
        $monitorBaiDu->request_headers = "";
        $monitorBaiDu->request_body = "";

        $monitorBaiDu->request_interval_second = 60 * 1;

        $monitorBaiDu->match_type = "http_status_code";
        $monitorBaiDu->match_content = "200";

        $monitorBaiDu->saveOrFail();

    }
}
