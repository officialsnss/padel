
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
                    <th>Payment Method</th>
                    <th>Refund Amount</th>
                    <th>Booking On</th>
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
                      <td>{{ $payment->total_amount }} {{ $payment->code }}</td>
                      <td>@if( $payment->payment_method == '1')
                        {{'KNET'}}
                        @else
                        {{ 'COD' }}
                        @endif
                       </td>
                       <td>@if($payment->isRefunded === '1')
                        <span class="st">{{ $payment->refund_price }} {{ $payment->code }}</span>
                        @elseif($payment->isRefunded === '2')
                        <span class="st">{{ '0 '.$payment->code }}</span>
                        @else
                        <span class="st">{{ '0 '.$payment->code }}</span>
                        @endif

                    </td>
                      <td>{{ date('d-m-Y', strtotime($payment->created_at)) }}</td>
                      @if($payment->isRefunded === '1')
                        <td><span class="st">Refunded</span></td>
                      @elseif($payment->isRefunded === '2')
                        <td><span class="st">Cancelled</span></td>
                      @else
                        <td><span class="st scancel">Cancel Request</span></td>
                      @endif
                       <td>
                       @if($payment->isRefunded === '0')
                        @if($payment->payment_method == '1')
                       <a class="btn btn-success" style="cursor: pointer" data-toggle="modal" data-target="#refundModal{{ $payment->pay_id }}">Approve</a>
                       @else
                       <a href="{{ route('refund.approve',$payment->pay_id) }}" class="btn btn-success" style="cursor: pointer">Approve</a>
                       @endif
                       <a class="btn btn-danger" style="cursor: pointer" data-toggle="modal" data-target="#rejectModal{{ $payment->pay_id }}">Rejected</a>
                      @endif
                     <!--Refund Modal -->
                    <div class="modal fade" id="refundModal{{ $payment->pay_id }}" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title">Refund Amount</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          <form method="post" action="{{ route('refund.add') }}" id="refundform">
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

                                              <input type="hidden" id="userid" class="form-control" value="{{ $payment->userid }}" name="userid">
                                              <input type="hidden" id="bookingid" class="form-control" value="{{ $payment->booking_id }}" name="bookingid">
                                              <input type="hidden" id="currencyid" class="form-control" value="{{ $payment->currency_id }}" name="currencyid">
                                              <input type="hidden" id="paymentid" class="form-control" value="{{ $payment->pay_id }}" name="paymentid">
                                              <div class="form-group row mb-0">
                                                  <div class="col-md-6 offset-md-4">
                                                      <button type="submit" class="btn btn-primary">
                                                        Submit
                                                      </button>
                                                  </div>
                                              </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                   <!--  End of refund modal-->
                    <!-- Reject MODAL -->

                    <div class="modal fade" id="rejectModal{{ $payment->pay_id }}" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
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
                                              <input type="hidden" id="repaymentid" class="form-control" value="{{ $payment->pay_id }}" name="repaymentid">
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
                      </td>
                    </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
      </div>
  </div>
</div>
@endsection
