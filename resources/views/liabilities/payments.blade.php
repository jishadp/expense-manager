@extends('layouts.master')
@section('title','Incomes')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 customeTopBar width100">
              <div class="headItems">
                <h1>Payments for #{{$liability->title}} ({{ number_format($payments->sum('amount'),2)}})</h1>
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

                          @foreach ($payments as $payment)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{date('d-M-Y, l',strtotime($payment->date))}}</td>
                            <td>{{$payment->title}}</td>
                            <td>{{number_format($payment->amount,2)}}</td>
                            <td><a class="btn btn-sm btn-danger" href="{{route('liabilities.payments.delete',encrypt($payment->id))}}">Delete</a></td>
                          <tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
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
          <form action="{{route('liabilities.payments.save')}}" method="post">
              @csrf
            <input type="hidden" name="liability_id" value="{{$liability->id}}">
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
