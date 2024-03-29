@extends('layouts.master')
@section('title','Expenses')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 customeTopBar width100">
            <div class="headItems">
                <h1>Expenses ({{ number_format(collect($paidExpenses)->sum('amount'),2)}})</h1>
            </div>
            <div class="rhsItms">
                <a href="{{ route('liabilities.list') }}" class="btn btn-warning pull-right">Back</a>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Add New</button>
            </div>
        </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row" style="margin-bottom: 10px;">
            <form action="{{ route('expenses.list') }}" method="get" style="width:auto; display: flex; column-gap: 10px; padding-left: 10px; justify-content: space-between; max-width: unset;">
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
                    <a href="{{ route('expenses.list') }}?year={{ date('Y')}}&month={{date('m')}}" class="btn btn-warning">Reset</a>
                </div>
            </form>
        </div>
      <div class="container-fluid">
        <div class="row">

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                <div class="card-header ">
                    <h3>{{number_format($paidExpenses->sum('amount'),2)}}</h3>- Paid
                </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Title</th>
                          <th>Amount</th>
                          <th style="width: 26%">Actions</th>
                        </tr>
                      </thead>
                      <tbody>

                          @foreach ($paidExpenses as $expense)
                          <tr>
                            <td>{{date('d-M',strtotime($expense->date))}}</td>
                            <td>{{$expense->title}}</td>
                            <td>{{number_format($expense->amount,2)}}</td>
                            <td>
                                @if($expense->status ==0)
                                <a class="btn btn-sm btn-primary" href="{{route('expense.change.status',encrypt($expense->id))}}">Mark Paid</a>
                                @else
                                <a class="btn btn-sm btn-info" href="{{route('expense.change.status',encrypt($expense->id))}}">Mark Unpaid</a>
                                @endif
                                <a class="btn btn-sm btn-danger" href="{{route('expense.delete',encrypt($expense->id))}}">Delete</a>
                            </td>
                          <tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>

              <div class="col-md-6">
                <div class="card">
                  <div class="card-header ">
                    <h3>{{number_format($unpaidExpenses->sum('amount'),2)}}</h3> - Topay
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Title</th>
                          <th>Amount</th>
                          <th style="width:29%;">Actions</th>
                        </tr>
                      </thead>
                      <tbody>

                          @foreach ($unpaidExpenses as $expense)
                          <tr>
                            <td>{{date('d-M',strtotime($expense->date))}}</td>
                            <td>{{$expense->title}}</td>
                            <td>{{number_format($expense->amount,2)}}</td>
                            <td>
                                @if($expense->status ==0)
                                <a class="btn btn-sm btn-primary" href="{{route('expense.change.status',encrypt($expense->id))}}">Mark Paid</a>
                                @else
                                <a class="btn btn-sm btn-info" href="{{route('expense.change.status',encrypt($expense->id))}}">Mark Unpaid</a>
                                @endif
                                <a class="btn btn-sm btn-secondary" href="{{route('expense.move',encrypt($expense->id))}}">Move</a>
                                <a class="btn btn-sm btn-danger" href="{{route('expense.delete',encrypt($expense->id))}}">Delete</a>
                            </td>
                          <tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">

                  </div>
                </div>
              </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('modals')
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
          <form action="{{route('expense.save')}}" method="post">
              @csrf
        <div class="modal-header">
          <h4 class="modal-title">New Entry</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

              <div class="form-group">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter Title">
              </div>

              <div class="form-group">
                <label for="">Date</label>
                <input type="text" class="form-control datepicker" value="{{date('Y-m-d')}}" name="date">
              </div>

              <div class="form-group">
                <label for="">Amount</label>
                <input type="text" class="form-control" name="amount" placeholder="Amount">
              </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
      </div>

      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection
