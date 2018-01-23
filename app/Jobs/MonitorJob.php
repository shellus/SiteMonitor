<?php

namespace App\Jobs;

use App\Monitor;
use App\Service\MonitorService;
use App\Service\SnapshotService;
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
        	\MonitorLog::info("未启用的监控：ID[{$this->monitor->id}], 跳过执行并再进入队列");
            MonitorService::joinQueue($this->monitor);
            return;
        }

	    \MonitorLog::debug("队列：监控ID[{$this->monitor->id}]，标题[{$this->monitor->title}]");

	    $snapshot = SnapshotService::createSnapshot(['monitor_id'=>$this->monitor->id]);

	    $requestResult = MonitorService::request($this->monitor);

	    MonitorService::storeSnapshot($snapshot, $requestResult);

	    MonitorService::updateMonitorData($this->monitor, $snapshot);

        MonitorService::handleSnapshotNotice($snapshot);

        MonitorService::joinQueue($this->monitor);

	    \MonitorLog::debug("队列：监控ID[{$this->monitor->id}]");
    }
}
