<?php

/**
 * Created by PhpStorm.
 * User: ANH
 * Date: 5/26/2017
 * Time: 3:41 PM
 */
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Services\Log\Logging;
use DB;

class TestActive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-active';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check test active';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
    }
}
