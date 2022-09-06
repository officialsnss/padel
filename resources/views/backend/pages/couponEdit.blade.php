@extends('backend.layouts.app')
@section('content')
    <div class="row">
        
        <div class="col-md-12">
          <div class="card card-primary">
           
      <div class="card-body reset-form">
         <form method="post" action="{{ route('coupon.update', $couponData->id) }}" id="couponform" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="row">  
            
              <div class="form-group col-md-6">
                <label for="inputName">Coupon Name</label>
                <input type="text" id="name" class="form-control" value="{{ $couponData->name }}" name="name">
                @error('name')
                <div class="form-error">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label for="inputName">Coupon Code</label>
                <input type="text" id="code" class="form-control" value="{{ $couponData->code }}" name="code">
               @error('code')
                <div class="form-error">{{ $message }}</div>
               @enderror
              </div>
             </div>  
             <div class="row"> 
               <div class="form-group col-md-6">
                <label for="inputName">No of users use</label>
                <input type="text" id="no_of_users_used" class="form-control" value="{{ $couponData->no_of_users_used }}" name="no_of_users_used">
                @error('no_of_users_used')
                <div class="form-error">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="inputName">No of times use</label>
                <input type="text" id="no_of_times" class="form-control" value="{{ $couponData->no_of_times }}" name="no_of_times">
                @error('no_of_times')
                <div class="form-error">{{ $message }}</div>
                @enderror
              </div>
             </div>
             

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                      <label for="inputName">Discount Type </label>
                          <select id="discount_type" name="discount_type" class="form-control">
                            <option value="">--- Select Discount type ---</option>
                            <option value="1" {{ ($couponData->discount_type == '1')?'selected':'' }}>Fixed</option>
                            <option value="2" {{ ($couponData->discount_type == '2')?'selected':'' }}>Percentage</option>
                           </select>
                            @error('discount_type')
                            <div class="form-error">{{ $message }}</div>
                            @enderror
                       </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                          <label for="inputName">Amount</label>
                            <div class="row">
                              <div class="col-md-10">
                              <input type="text" id="amount" class="form-control" value="{{ $couponData->amount }}" name="amount">
                              </div>
                              <div class="col-md-2">
                                <input type="text" class="form-control" value="KWD"  id="curr" readonly>
                              </div>
                            </div>    
                              @error('amount')
                                <div class="form-error">{{ $message }}</div>
                              @enderror
                       </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                          <label for="inputName">Minimum Amount</label>
                            <div class="row">
                              <div class="col-md-10">
                              <input type="text" id="minimum_amount" class="form-control" value="{{ $couponData->minimum_amount }}" name="minimum_amount">
                              </div>
                              <div class="col-md-2">
                                <input type="text" class="form-control" value="KWD" readonly>
                              </div>
                            </div>    
                              @error('minimum_amount')
                                <div class="form-error">{{ $message }}</div>
                              @enderror
                       </div>
                     
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputName">Status </label>
                      <?php
                        
                      ?>
                          <select id="status" name="status" class="form-control">
                            <option value="">--- Select Status ---</option>
                            <option value="1" {{ ($couponData->status == '1')?'selected':'' }}>Active</option>
                            <option value="2" {{ ($couponData->status == '2')?'selected':'' }}>Inactive</option>
                           </select>
                            @error('status')
                            <div class="form-error">{{ $message }}</div>
                            @enderror
                       </div>
                    </div>
                  </div>

                 
              <div class="row">
              <div class="form-group col-md-12">
                <button type="submit" class="btn btn-success">Save</button>
              </div>  
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
    
   </div>
 
   <script>
  $( "#discount_type" ).change(function() {
    var disValue = $( "#discount_type" ).val();
 
    if(disValue == '2'){
       $('#curr').val('%');
    }
    else{
      $('#curr').val('KWD');
    }
});
  </script>
        @endsection
        