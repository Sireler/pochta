<?php

namespace App\Jobs;

use App\RegistryRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessRecord implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $registryRecord;

    /**
     * Create a new job instance.
     *
     * @param RegistryRecord $record
     */
    public function __construct(RegistryRecord $record)
    {
        $this->registryRecord = $record;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
