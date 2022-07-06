
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
                    <th>transaction id</th>
                    <th>Total Amount Paid</th>
                   
                  </tr>
                  </thead>
                  <tbody>
                    
                  @foreach ($payments as $payment)
                    <tr>
                      <td></td>
                      <td>{{ $payment->name }}</td>
                      <td>{{ $payment->email }}</td>
                      <td>{{ $payment->transaction_id }}</td>
                      <td>{{ $payment->total_amount }} {{ $payment->code }}</td>
                     <!-- @if($payment->payment_status === '1')
                        <td >Completed</td>
                      @elseif($payment->payment_status === '2')
                        <td>Pending</td>
                      @elseif($payment->payment_status === '3')
                        <td>Cancellation</td>
                      @else
                       <td>Refunded</td>
                       @endif; -->
                     
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
  