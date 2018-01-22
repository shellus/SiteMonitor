<?php

namespace App\Console\Commands;

use App\Service\SnapshotService;
use App\Snapshot;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SnapshotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'snapshot:clear {deadline-second}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $deadlineTime = Carbon::now()->subSecond($this->argument('deadline-second'));
        $jobStartTime = Carbon::now();
        $count = 0;

        Snapshot::where('created_at', '<', $deadlineTime)->chunk(100, function($snapshots)use (&$count) {
            /** @var \App\Snapshot $snapshot */
            foreach ($snapshots as $snapshot) {
                try{
                    if(SnapshotService::deleteSnapshot($snapshot->id)){
                        $count++;
                    }
                }catch (ModelNotFoundException $e){
                    $idStr = implode(',', $e->getIds());
                    $this->warn("Snapshots [$idStr] not found, Ignore and continue");
                }
            }
        });
        $second = Carbon::now()->diffInSeconds($jobStartTime);
        $this->info("Delete {$count} snapshots before {$deadlineTime} in {$second} second ! ");
    }
}
