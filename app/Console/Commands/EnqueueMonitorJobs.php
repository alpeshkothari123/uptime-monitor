<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Website;
use App\Jobs\MonitorWebsiteJob;

class EnqueueMonitorJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:enqueue-monitor-jobs';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enqueue monitor jobs for active websites';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Website::where('active', true)->chunk(100, function($websites){
        foreach($websites as $website) {
        MonitorWebsiteJob::dispatch($website);
        }
        });


        $this->info('Enqueued monitor jobs.');
    }
}
