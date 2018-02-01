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
            $table->unsignedInteger('project_id');
            $table->string('title');
            $table->text('request_url');
            $table->text('request_method');
            $table->text('request_headers')->nullable(); // 不包含首行
            $table->text('request_body')->nullable();

            $table->boolean('request_nobody')->default(false); // 是否不请求body
            $table->boolean('is_enable')->default(true); // 是否启用监控
            $table->boolean('is_public')->default(false); // 是否启用监控
            $table->boolean('no_notice_error')->default(false); // 是否不通知错误
            $table->boolean('no_notice_match')->default(false); // 是否不通知匹配

            $table->unsignedInteger('interval_normal'); // 未匹配也无错误的情况下间隔秒数
            $table->unsignedInteger('interval_match'); // 匹配的情况下间隔秒数
            $table->unsignedInteger('interval_error'); // 出错的情况下间隔秒数

	        $table->boolean('request_follow_location')->default(true); // 是否跟随跳转

            $table->string('match_type'); // include / http_status_code / timeout
            $table->boolean('match_reverse')->default(false); // 相反匹配，例如timeout 翻转的话，就是如果响应时间快于x毫秒，则通知
            $table->string('match_content'); // 内容或状态吗
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects');
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
            $table->dropForeign(['project_id']);
        });

        Schema::dropIfExists('monitors');
    }
}
