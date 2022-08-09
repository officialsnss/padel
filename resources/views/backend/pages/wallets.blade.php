
@extends('backend.layouts.app')
@section('content')

<div class="row">
  <div class="col-12">
      <div class="card">
      
        
              <div class="card-header">
                <div class="row">
                <div class="col-md-6" style="font-size:18px">
                  <strong>Balance:</strong> {{ $balance }} KWD
                  </div>
                
                  <div class="col-md-6" style="text-align:right">
                    <a class="btn btn-success {{ ($balance <= 0)?'disabled':'' }}" style="cursor: pointer" data-toggle="modal" data-target="#withdrawalModal">Withdraw Amount</a>
                  </div>

                  </div>
                 <!--Refund Modal -->
                 <div class="modal fade" id="withdrawalModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title">Withdrawl Amount</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          <form method="post" action="{{ route('wallets.withdraw', $userId) }}" id="withdrawalform">
                                              @csrf
                                            <div class="form-group">
                                                <label for="inputName">Withdraw Amount</label>
                                                <input type="text" id="withdrawal_amt" class="form-control" value="" name="withdrawal_amt">
                                                    @error('withdrawal_amt')
                                                    <div class="form-error">{{ $message }}</div>
                                                    @enderror
                                              </div>
                                              
          
                                              <input type="hidden" id="balamount" class="form-control" value="{{  $balance }}" name="balamount" readonly>
                                             
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
              </div>
            
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped walletTable">
                  <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Amount</th>
                    <th>Notes</th>
                   
                  </tr>
                  </thead>
                  <tbody>
                    
                  @foreach ($wallets as $wallet)
                    <tr>
                      <td></td>
                      <td>{{ $wallet->amount }} {{ $wallet->code }}</td>
                     
                       @if($wallet->status == '1')
                             <td><i class="fas fa-arrow-down"></i>Refunded By Admin  </td>
                        @elseif($wallet->status == '2')  
                            <td><i class="fas fa-arrow-up"></i>Booking done by user</td>
                        @else
                            <td><i class="fas fa-arrow-up"></i>Withdraw By Admin </td>
                         @endif 
                      
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
  