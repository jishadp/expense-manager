<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Expense;
use App\Models\Liability;

class LiabilityController
{
    public function list(){
        $liabilities = Liability::orderBy('amount','desc')->paginate(25);
        $banks = Bank::all();
        return view('liabilities.list',compact('liabilities','banks'));
    }
    public function save(){
        Liability::create([
            'title' => strtoupper(request('title')),
            'type' => request('type'),
            'bank_id' => request('bank_id'),
            'taken_date' => date('Y-m-d',strtotime(request('taken_date'))),
            'amount' => request('amount'),
        ]);
        return redirect()->route('liabilities.list');
    }

    public function delete($id){
        $liability = Liability::find(decrypt($id));
        Expense::where('liability_id',$liability->id)->delete();
        $liability->delete();
        return redirect()->route('liabilities.list');
    }

}
