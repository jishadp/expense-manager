@extends('layouts.master')
@section('title','Incomes')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 customeTopBar width100">
            <div class="headItems">
                <h1>Incomes ({{ number_format(collect($incomes)->sum('amount'),2)}})</h1>
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
            <form action="{{ route('incomes.list') }}" method="get" style="width:auto; display: flex; column-gap: 10px; padding-left: 10px; justify-content: space-between; max-width: unset;">
                <div class="col-md-1" style="width: 90%; padding:0; margin:0; max-width: unset; flex: auto;">
                    <select name="year" class="form-control" class="width: 100%;">
                        @for ($year = 2023; $year <= 2023; $year++)
                            <option @selected($year == request('month')) value="{{ $year }}">{{ $year}}</option>
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
                    <a href="{{ route('incomes.list') }}?year={{ date('Y')}}&month={{date('m')}}" class="btn btn-warning">Reset</a>
                </div>
            </form>
        </div>
      <div class="container-fluid">
        <div class="row">

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header ">
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Date</th>
                          <th>Title</th>
                          <th>Amount</th>
                          <th style="width: 2%">Actions</th>
                        </tr>
                      </thead>
                      <tbody>

                          @foreach ($incomes as $income)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{date('d-M-Y, l',strtotime($income->date))}}</td>
                            <td>{{$income->how}}</td>
                            <td>{{number_format($income->amount,2)}}</td>
                            <td><a class="btn btn-sm btn-danger" href="{{route('income.delete',encrypt($income->id))}}">Delete</a></td>
                          <tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
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
          <form action="{{route('income.save')}}" method="post">
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
                <input type="text" class="form-control" name="how" placeholder="Enter Title">
              </div>

              <div class="form-group">
                <label for="">Date</label>
                <input type="text" class="form-control datepicker" value="{{date('Y-m-d')}}" name="taken_date">
              </div>

              <div class="form-group">
                <label for="">Type</label>
                  <select name="type" class="form-control">
                      <option value="1">Bank</option>
                      <option value="0">Individual</option>
                  </select>
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
