<?php

namespace App\Console\Commands;

use App\Payment;
use Illuminate\Console\Command;

class DailyExpiryCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expiry:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respectively check expiry date for every user on daily bases.';

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
        $paid_user = Payment::where('transaction_expiry_date','<',date('Y-m-d'))
            ->where('is_expire',false)
            ->where('is_paid_by_admin',false);
        if($paid_user->count() > 0)
        {
            $expiry_users_ids = $paid_user->pluck('id');
            Payment::whereIn('id',$expiry_users_ids)->update(['is_expire' => true]);
//            dd($paid_user->first());
        }
//        dd('checked');
    }
}
