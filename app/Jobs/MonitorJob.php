<?php

namespace App\Jobs;

use App\Monitor;
use App\Service\MonitorService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MonitorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $monitor;

    /**
     * Create a new job instance.
     *
     * @param Monitor $monitor
     */
    public function __construct(Monitor $monitor)
    {
        $this->monitor = $monitor;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $snapshot = MonitorService::request($this->monitor);
        MonitorService::handleSnapshot($snapshot);
        MonitorService::joinQueue($this->monitor);
    }
}
