<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 设置diff输出的语言类型
        Carbon::setLocale(config('app.carbon_locale'));

        // varchar索引长度报错修复
        \Schema::defaultStringLength(191);

	    $log_name = 'monitor';
	    $log_file = storage_path('logs' . DIRECTORY_SEPARATOR . $log_name . '.log');
	    $sqlLogger = new Logger($log_name, [new StreamHandler($log_file, config('app.log_level'))]);
	    $this->app->instance('monitorLog', $sqlLogger);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
