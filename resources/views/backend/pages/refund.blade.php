
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
                    <th>Status</th>
                    <th>Actions</th>
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
                      @if($payment->payment_status === '1')
                        <td >Completed</td>
                      @elseif($payment->payment_status === '2')
                        <td>Pending</td>
                      @elseif($payment->payment_status === '3')
                        <td>Cancellation</td>
                       @elseif($payment->payment_status === '4')
                        <td>Refunded</td>
                      @else
                       <td>Request for Cancellation</td>
                       @endif
                       <td>
                     
                       <a class="btn btn-success" style="cursor: pointer" data-toggle="modal" data-target="#refundModal">Refund</a>
                            </li>
                      </td>
                       <!--Refund Modal -->
                          <div class="modal fade" id="refundModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title">Refund Amount</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          <form method="POST" id="registerForm">
                                              @csrf
                                              <div class="form-group">
                                                <label for="inputName">Amount Paid</label>
                                                <input type="text" id="totalamount" class="form-control" value="{{ $payment->total_amount }}" name="totalamount" readonly>
                                                    @error('totalamount')
                                                    <div class="form-error">{{ $message }}</div>
                                                    @enderror
                                              </div>

                                              <div class="form-group">
                                                <label for="inputName">Refunded Amount</label>
                                                <input type="text" id="refund_amt" class="form-control" value="" name="refund_amt">
                                                    @error('refund_amt')
                                                    <div class="form-error">{{ $message }}</div>
                                                    @enderror
                                              </div>

                                              <div class="form-group row mb-0">
                                                  <div class="col-md-6 offset-md-4">
                                                      <button type="submit" class="btn btn-primary">
                                                        Submit
                                                      </button>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>

<!--  End of POPUP-->
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
  