@extends('layouts.master')
@section('title','Expenses')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 customeTopBar width100">
            <div class="headItems">
                <h1>Hi Jishad, Your {{ date(request('m'))}} month P & L is very week. </h1>
            </div>
        </div>
        </div>
      </div>
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="row" style="margin-bottom: 10px;">
            <form action="{{ route('pnl.view') }}" method="get" style="width:auto; display: flex; column-gap: 10px; padding-left: 10px; justify-content: space-between; max-width: unset;">
                <div class="col-md-1" style="width: 90%; padding:0; margin:0; max-width: unset; flex: auto;">
                    <select name="year" class="form-control" class="width: 100%;">
                        @for ($year = 2023; $year <= 2024; $year++)
                            <option @selected($year == request('year')) value="{{ $year }}">{{ $year}}</option>
                        @endfor
                    </select>

                </div>
                <div class="col-md-1" style="width: 90%; padding:0; margin:0; max-width: unset; flex: auto;">
                    <select name="month" class="form-control" class="width: 100%;">
                        @php $year = date('Y'); @endphp
                        @for ($month = 1; $month <= 12; $month++)
                            @php $date = new DateTime("$year-$month-01") @endphp
                            <option @selected($date->format('m')==request('month')) value="{{ $date->format('m') }}">{{ $date->format('F') }}</option>
                        @endfor
                    </select>

                </div>

                <div class="col-md-2" style="float: left;">
                    <input type="submit" class="btn btn-primary" value="Filter">
                </div>

                <div class="col-md-2" style="float: left;">
                    <a href="{{ route('pnl.view') }}?year={{ date('Y')}}&month={{date('m')}}" class="btn btn-warning">Reset</a>
                </div>
            </form>
        </div>
      <div class="container-fluid">

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                  <div class="card-header ">
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>

                            @foreach ($incomes as $income)
                            <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$income->how}}</td>
                              {{-- <td>{{number_format($income->amount,2)}}</td> --}}
                            <tr>
                            @endforeach
                        </tbody>
                      </table>
                    </table>
                  </div>
                  <!-- /.card-body -->

                </div>
              </div>
              <div class="col-md-2">
                <div class="card">
                  <div class="card-header ">
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="P100Div">
                        <div class="spanHead">Incomes</div>
                        <div class="spanHead text-right text-green">{{number_format($incomes->sum('amount'),2)}}</div>
                    </div>

                    <div class="P100Div">
                        <div class="spanHead">Expenses</div>
                        <div class="spanHead text-right text-red">{{number_format($expenses->sum('amount'),2)}}</div>
                    </div>

                    <div class="P100Div">
                        <div class="spanHead">Balance</div>
                        <div class="spanHead text-right"><strong>{{number_format($incomes->sum('amount') - $expenses->sum('amount'),2)}}</strong></div>
                    </div>

                    </table>
                  </div>
                  <!-- /.card-body -->

                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header ">
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>

                            @foreach ($expenses as $expense)
                            <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{date('d-M-Y, l',strtotime($expense->date))}}</td>
                              <td>{{$expense->title}}
                                @isset($expense->liability)
                                    <span liability="{{ $expense->liability }}"
                                        @isset($expense->liability->payments)
                                        payments="{{ collect($expense->liability->payments)->sum('amount') }}"
                                        @endisset
                                        @isset($expense->liability->payments)
                                        balance="{{ $expense->liability->amount + collect($expense->liability->interests)->sum('amount') - collect($expense->liability->payments)->sum('amount') }}"
                                        @endisset
                                        class="right badge badge-success text-right hoverMe">info</span>
                                @endisset
                                </td>
                              <td>{{number_format($expense->amount,2)}}</td>
                              <td>@if($expense->status ==1) <span class="right badge badge-success">Paid</span> @else <span class="right badge badge-danger">Unpaid</span> @endif</td>
                            <tr>
                            @endforeach
                        </tbody>
                      </table>

                    </table>
                  </div>
                  <!-- /.card-body -->

                </div>
                <div class="hoverBody">
                    <h4>Liability: Home Loan</h4>
                    <h4>Payments: 39878</h4>
                    <h4>Total Paid: 3423</h4>
                    <h4>Total Paid: 3423</h4>
                    <button class="btn btn-xs btn-danger hovermeClose">Close</button>
                </div>
              </div>
        </div>
      </div>
    </section>
  </div>
@endsection
