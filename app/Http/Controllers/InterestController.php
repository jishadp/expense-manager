<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\Liability;

class InterestController
{
    public function list($liabilityId){
        $liability = Liability::find(decrypt($liabilityId));
        $interests = Interest::where('liability_id',decrypt($liabilityId))->orderBy('date','desc')->get();
        return view('liabilities.interests',compact('interests','liability'));
    }
    public function save(){
        Interest::create([
            'title' => strtoupper(request('title')),
            'liability_id' => request('liability_id'),
            'date' => date('Y-m-d',strtotime(request('date'))),
            'amount' => request('amount'),
        ]);
        return redirect()->route('liabilities.interests.list',encrypt(request('liability_id')));
    }

    public function delete($id){
        $interest = Interest::find(decrypt($id));
        $liability = Liability::find($interest->liability_id);
        $interest->delete();
        return redirect()->route('liabilities.interests.list',encrypt($liability->id));
    }

}
