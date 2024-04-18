<?php

namespace App\Console\Commands;

use App\Models\Expense;
use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;

class GenerateRecurringExpense extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-recurring-expense';

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
        $month = $this->ask('Which Month Eg: 04 ?');
        $year = $this->ask('Which Year ?');

        Expense::whereMonth('date',$month)->whereYear('date',$year)->delete();

        Expense::create([
            'title'   =>'ICICI PERSONAL LOAN',
            'date'  =>date($year."-".$month."-01"),
            'liability_id' => 15,
            'amount'  =>2005,
        ]);

        Expense::create([
            'title'   =>'SIP',
            'date'  =>date($year."-".$month."-01"),
            'amount'  =>5670,
        ]);

        Expense::create([
            'title'   =>'OFFICE KURI',
            'date'  =>date($year."-".$month."-01"),
            'amount'  =>10000,
        ]);

        Expense::create([
            'title'   =>'HAIR CUT',
            'date'  =>date($year."-".$month."-01"),
            'amount'  =>200,
        ]);
        Expense::create([
            'title'   =>'IPHONE EMI',
            'date'  =>date($year."-".$month."-01"),
            'amount'  =>7114,
        ]);

        Expense::create([
            'title'   =>'CAR LOAN',
            'date'  =>date($year."-".$month."-01"),
            'liability_id' => 2,
            'amount'  =>17600,
        ]);

        Expense::create([
            'title'   =>'HOUSING LOAN',
            'date'  =>date($year."-".$month."-01"),
            'liability_id' => 8,
            'amount'  =>14420,
        ]);

        Expense::create([
            'title'   =>'MY MOBILE RECHARGE',
            'date'  =>date($year."-".$month."-01"),
            'amount'  =>239,
        ]);

        Expense::create([
            'title'   =>'MALANAD HOME BROADBAND',
            'date'  =>date($year."-".$month."-01"),
            'amount'  =>590,
        ]);

        Expense::create([
            'title'   =>'YUVANS MEMBERSHIP FEE',
            'date'  =>date($year."-".$month."-01"),
            'amount'  =>200,
        ]);

        Expense::create([
            'title'   =>'PARENTS ALLOWANCE',
            'date'  =>date($year."-".$month."-01"),
            'amount'  =>10000,
        ]);

        Expense::create([
            'title'   =>'RATION HOME',
            'date'  =>date($year."-".$month."-01"),
            'amount'  =>5000,
        ]);

        Expense::create([
            'title'   =>'DIESEL',
            'date'  =>date($year."-".$month."-01"),
            'amount'  =>3300,
        ]);

        Expense::create([
            'title'   =>'CAR WASH',
            'date'  =>date($year."-".$month."-01"),
            'amount'  =>430,
        ]);
    }
}
