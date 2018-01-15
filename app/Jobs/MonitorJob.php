<?php

namespace App\Jobs;

use App\Monitor;
use App\Service\MonitorService;
use App\Snapshot;
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
        if ($this->monitor->is_enable===false){
            MonitorService::joinQueue($this->monitor);
            return;
        }
	    $snapshot = $this->monitor->snapshots()->create();

	    $requestResult = MonitorService::request($this->monitor);

	    MonitorService::storeSnapshot($snapshot, $requestResult);

	    MonitorService::updateMonitorData($this->monitor, $snapshot);

        MonitorService::handleSnapshotNotice($snapshot);

        MonitorService::joinQueue($this->monitor);
    }
}
