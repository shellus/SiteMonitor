<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 监控任务
 * Class CreateMonitorsTable
 */
class CreateMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitors', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->text('request_url');
            $table->text('request_method');
            $table->text('request_headers'); // 不包含首行
            $table->text('request_body');

            $table->boolean('request_nobody')->default(false); // 是否不请求body
            $table->boolean('is_enable')->default(false); // 是否启用监控
            $table->boolean('last_error')->default(false);
            $table->boolean('last_match')->default(false);

            $table->timestamp('last_error_time')->nullable();
            $table->timestamp('last_match_time')->nullable();
            $table->timestamp('last_request_time')->nullable();

            $table->unsignedInteger('time_total_average_15minute')->default(0);
            $table->unsignedInteger('time_total_average_30minute');
            $table->unsignedInteger('time_total_average_1hour');
            $table->unsignedInteger('time_total_average_12hour');
            $table->unsignedInteger('time_total_average_24hour');


            $table->unsignedInteger('interval_normal'); // 未匹配也无错误的情况下间隔秒数
            $table->unsignedInteger('interval_match'); // 匹配的情况下间隔秒数
            $table->unsignedInteger('interval_error'); // 出错的情况下间隔秒数

            $table->string('match_type'); // include / http_status_code / timeout
            $table->boolean('match_reverse')->default(false); // 相反匹配，例如timeout 翻转的话，就是如果响应时间快于x毫秒，则通知
            $table->string('match_content'); // 内容或状态吗
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monitors', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('monitors');
    }
}
