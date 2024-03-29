<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;

class PNLController
{
    public function view(){
        $expenses = Expense::with('liability','liability.payments','liability.interests')->orderBy('date','desc')
                    ->when(request('month'),function($query){
                       $query->whereMonth('date',request('month'));
                    },function($query){
                        $query->whereMonth('date',date('m'));
                    })
                    ->when(request('year'),function($query){
                        $query->whereYear('date',request('year'));
                    },function($query){
                        $query->whereYear('date',date('Y'));
                    })->get();


        $incomes = Income::orderBy('date','desc')
                ->when(request('month'),function($query){
                $query->whereMonth('date',request('month'));
                },function($query){
                    $query->whereMonth('date',date('m'));
                })
                ->when(request('year'),function($query){
                    $query->whereYear('date',request('year'));
                },function($query){
                    $query->whereYear('date',date('Y'));
                })->get();
        return view('pnl',compact('expenses','incomes'));
    }
}
