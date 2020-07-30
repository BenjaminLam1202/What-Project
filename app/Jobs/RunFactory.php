<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\User;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class RunFactory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $output       = new ConsoleOutput();

        $progressBar  = new ProgressBar($output, 10);

        $progressBar->start();

        for ($i=0; $i < 100; $i++) {    

            User::insert(factory(User::class, 100)->make()->makeVisible(['password','remember_token'])->toArray());

            $progressBar->advance();

        }
        
        $progressBar->finish();        //
    }
}
