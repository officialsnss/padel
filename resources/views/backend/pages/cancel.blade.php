
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
                    <th>Booking On</th>
                    <th>Payment Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  @foreach ($payments as $payment)
                    <tr>
                      <td></td>
                      <td>{{ $payment->name }}</td>
                      <td>{{ $payment->email }}</td>
                      <td>{{ $payment->total_amount }} {{ $payment->code }}</td>
                      <td>{{ date('d-m-Y', strtotime($payment->created_at)) }}</td>
                      @if($payment->payment_status === '1')
                        <td >Completed</td>
                      @else
                        <td>Pending</td>
                      @endif
                       <td>
                     
                       <a class="btn btn-success" style="cursor: pointer" data-toggle="modal" data-target="#refundModal{{ $payment->id }}">Approve</a>
                       <a class="btn btn-danger" style="cursor: pointer" data-toggle="modal" data-target="#rejectModal{{ $payment->id }}">Rejected</a>
                      </li>
                      </td>
                       <!--Refund Modal -->
                          <div class="modal fade" id="refundModal{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title">Refund Amount</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          <form method="post" action="{{ route('refund.add') }}">
                                              @csrf
                                              <div class="form-group">
                                                <label for="inputName">Amount Paid (In {{ $payment->code }})</label>
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

                                              <input type="hidden" id="userid" class="form-control" value="{{ $payment->id }}" name="userid">
                                              <input type="hidden" id="bookingid" class="form-control" value="{{ $payment->booking_id }}" name="bookingid">
                                              <input type="hidden" id="currencyid" class="form-control" value="{{ $payment->currency_id }}" name="currencyid">
                                              <input type="hidden" id="paymentid" class="form-control" value="{{ $payment->id }}" name="paymentid">
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
                   <!--  End of refund modal-->

                   <!-- Reject MODAL -->
                   
                     <div class="modal fade" id="rejectModal{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title">Rejection Email</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          <form method="post" action="{{ route('refund.reject') }}" id="rejectform">
                                              @csrf
                                            <div class="form-group">
                                                <label for="inputName">To</label>
                                                <input type="text" id="useremail" class="form-control" value="{{ $payment->email }}" name="useremail" readonly>
                                                    @error('useremail')
                                                    <div class="form-error">{{ $message }}</div>
                                                    @enderror
                                              </div>
                                              <div class="form-group">
                                                <label for="inputName">Message</label>
                                                <textarea rows="4" id="messagebody" class="form-control" value="{{ $payment->email }}" name="messagebody">Your Cancellation Request has been rejected.</textarea>
                                                    @error('messagebody')
                                                    <div class="form-error">{{ $message }}</div>
                                                    @enderror
                                              </div>

                                              <input type="hidden" id="userName" class="form-control" value="{{ $payment->name }}" name="userName">
                                              <input type="hidden" id="repaymentid" class="form-control" value="{{ $payment->id }}" name="repaymentid">
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
                   <!-- End Reject Modal -->
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
  