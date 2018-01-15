<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitorDatasTable extends Migration
{
	protected $dates = ['created_at', 'updated_at', 'last_match_time', 'last_error_time', 'last_request_time'];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitor_datas', function (Blueprint $table) {
            $table->increments('monitor_id');

	        $table->text('last_1hour_table_cache')->nullable();

	        $table->boolean('last_error')->default(false);
	        $table->boolean('last_match')->default(false);

            $table->unsignedInteger('last_status_level')->default(0);
            $table->string('last_status_text')->nullable();

	        $table->timestamp('last_error_time')->nullable();
	        $table->timestamp('last_match_time')->nullable();
	        $table->timestamp('last_request_time')->nullable();

	        $table->unsignedInteger('time_total_average_15minute')->default(0)->nullable();;
	        $table->unsignedInteger('time_total_average_30minute')->default(0)->nullable();;
	        $table->unsignedInteger('time_total_average_1hour')->default(0)->nullable();;
	        $table->unsignedInteger('time_total_average_12hour')->default(0)->nullable();;
	        $table->unsignedInteger('time_total_average_24hour')->default(0)->nullable();;

            $table->timestamps();

	        $table->foreign('monitor_id')->references('id')->on('monitors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('monitor_datas', function (Blueprint $table) {
		    $table->dropForeign(['monitor_id']);
	    });

        Schema::dropIfExists('monitor_datas');
    }
}
