<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Carbon\Carbon;

class ExpenseController
{
    public function list(){
        $paidExpenses = Expense::where('status',1)->orderBy('date','desc')->when(request('month'),function($query){
            $query->whereMonth('date',request('month'));
         },function($query){
             $query->whereMonth('date',date('m'));
         })
         ->when(request('year'),function($query){
             $query->whereYear('date',request('year'));
         },function($query){
             $query->whereYear('date',date('Y'));
         })->get();
        $unpaidExpenses = Expense::where('status',0)->orderBy('date','desc')->when(request('month'),function($query){
            $query->whereMonth('date',request('month'));
         },function($query){
             $query->whereMonth('date',date('m'));
         })
         ->when(request('year'),function($query){
             $query->whereYear('date',request('year'));
         },function($query){
             $query->whereYear('date',date('Y'));
         })->get();
        return view('expenses',compact('paidExpenses','unpaidExpenses'));
    }
    public function save(){
        Expense::create([
            'title' => strtoupper(request('title')),
            'date' => date('Y-m-d',strtotime(request('date'))),
            'amount' => request('amount'),
        ]);
        return redirect()->back();
    }

    public function delete($id){
        Expense::find(decrypt($id))->delete();
        return redirect()->back();
    }

    public function changeExpenseStatus($id){
        $expense = Expense::find(decrypt($id));
        $newStatus = ($expense->status == 1) ? 0 : 1;
        $expense->update(['status'=>$newStatus]);
        return redirect()->back();
    }
    public function move($id){
        $expense = Expense::find(decrypt($id));
        $expense->update([
            'date'  => Carbon::parse($expense->date)->addMonth()->firstOfMonth(),
        ]);
        return redirect()->back();
    }

}
