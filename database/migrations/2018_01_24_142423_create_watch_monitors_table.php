<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWatchMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watch_monitor', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('monitor_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('monitor_id')->references('id')->on('monitors');
            $table->primary(['user_id', 'monitor_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('watch_monitor');
    }
}
