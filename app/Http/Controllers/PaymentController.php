<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Liability;
use App\Models\Payment;

class PaymentController
{
    public function list($liabilityId){
        $liability = Liability::find(decrypt($liabilityId));
        $payments = Payment::where('liability_id',decrypt($liabilityId))->orderBy('date','desc')->get();
        return view('liabilities.payments',compact('payments','liability'));
    }
    public function save(){
        Payment::create([
            'title' => strtoupper(request('title')),
            'liability_id' => request('liability_id'),
            'date' => date('Y-m-d',strtotime(request('date'))),
            'amount' => request('amount'),
        ]);
        return redirect()->route('liabilities.payments.list',encrypt(request('liability_id')));
    }

    public function delete($id){
        $payment = Payment::find(decrypt($id))->delete();
        $liability = Liability::find($payment->liability_id);
        $payment->delete();
        return redirect()->route('liabilities.payments.list',encrypt($liability->id));
    }

}
