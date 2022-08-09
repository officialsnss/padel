
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
         
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Total Amount Paid</th>
                    <th>Total Amount Refunded</th>
                    <th>Booking On</th>
                   
                   
                  </tr>
                  </thead>
                  <tbody>
                    
                  @foreach ($payments as $payment)
                    <tr>
                      <td></td>
                      <td>{{ $payment->name }}</td>
                      <td>{{ $payment->email }}</td>
                      <td>{{ $payment->total_amount }} {{ $payment->code }}</td>
                      <td>{{ $payment->refund_price }} {{ $payment->code }}</td>
                      <td>{{ date('d-m-Y', strtotime($payment->created_at)) }}</td>
                     
                      
                      
                  </tr>
                  @endforeach
                  
                  </tbody>
                
                </table>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
   
        <!-- /.row -->

        @endsection
  