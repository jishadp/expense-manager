<?php

namespace App\Console\Commands;

use App\Models\Income;
use Illuminate\Console\Command;

class CreditSalaryEveryMonth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:credit-salary-every-month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $month = '04';
        $year = 2024;
        Income::create([
            'how'   =>'Salary Credited from IOCOD',
            'date'  =>date($year."-".$month."-05"),
            'amount'  =>125500,
        ]);
    }
}
