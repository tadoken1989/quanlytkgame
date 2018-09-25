<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Models\LogOnline;

class LogUserOnline extends Command
{

    protected $sqlSrv;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log-user-online';

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
        $this->sqlSrv = DB::connection('sqlsrv');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $account = $this->sqlSrv->select("SELECT cAccName FROM Account_Info WHERE iClientID = '1' ");
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $log = new LogOnline();
        $log->time = $time;
        $log->day = $date;
        $log->count = count($account);
        $log->save();
        return $this->comment('Logging done !');
    }
}
