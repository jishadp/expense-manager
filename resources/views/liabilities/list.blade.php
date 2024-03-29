@extends('layouts.master')
@section('title','Liabilities')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12 customeTopBar width100">
                <div class="headItems">
                    <h1>Liabilities ({{ number_format(collect($liabilities->items())->sum('amount'),2)}}) - {{shortNumber(collect($liabilities->items())->sum('amount'))}}</h1>
                </div>
                <div class="rhsItms">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Add New</button>
                </div>
            </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
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
                          <th>Due Date</th>
                          <th style="width: 17%">Actions</th>
                        </tr>
                      </thead>
                      <tbody>

                          @foreach ($liabilities as $liability)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{date('d-M-Y',strtotime($liability->taken_date))}}</td>
                            <td>{{$liability->title}}</td>
                            <td>{{number_format(($liability->amount + $liability->interests->sum('amount') - $liability->payments->sum('amount')),2)}}</td>
                            <td>@if(filled($liability->due_date)) {{date('d-M-Y',strtotime($liability->due_date))}} @endif</td>
                            <td>
                                <a class="btn btn-sm btn-info" href="{{route('liabilities.interests.list',encrypt($liability->id))}}">Interests</a>
                                <a class="btn btn-sm btn-primary" href="{{route('liabilities.payments.list',encrypt($liability->id))}}">Payments</a>
                                <a class="btn btn-sm btn-danger" href="{{route('liabilities.delete',encrypt($liability->id))}}">Delete</a>
                            </td>
                          <tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    {{$liabilities->links()}}
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
          <form action="{{route('liabilities.save')}}" method="post">
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
                <input type="text" class="form-control datepicker" value="{{date('Y-m-d')}}" name="taken_date">
              </div>

              <div class="form-group">
                <label for="">Type</label>
                  <select name="type" class="form-control">
                      <option value="1">Bank</option>
                      <option value="0">Individual</option>
                  </select>
              </div>

              <div class="form-group bankDiv">
                <label for="">Bank</label>
                  <select name="bank_id" class="form-control">
                      @foreach ($banks as $bank)
                      <option value="{{$bank->id}}">{{ $bank->name }}</option>
                      @endforeach
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
