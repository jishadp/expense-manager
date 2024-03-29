<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Income;
use App\Models\Liability;

class IncomeController
{
    public function list(){
        $incomes = Income::orderBy('amount','desc')->when(request('month'),function($query){
                    $query->whereMonth('date',request('month'));
                    },function($query){
                        $query->whereMonth('date',date('m'));
                    })
                    ->when(request('year'),function($query){
                        $query->whereYear('date',request('year'));
                    },function($query){
                        $query->whereYear('date',date('Y'));
                    })->get();
        return view('incomes',compact('incomes'));
    }
    public function save(){
        Income::create([
            'how' => strtoupper(request('how')),
            'date' => date('Y-m-d',strtotime(request('taken_date'))),
            'amount' => request('amount'),
        ]);
        return redirect()->route('incomes.list');
    }

    public function delete($id){
        Income::find(decrypt($id))->delete();
        return redirect()->route('incomes.list');
    }

}
