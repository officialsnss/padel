@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
          <div class="card card-primary">
           
            <div class="card-body reset-form">
         <form method="post" action="{{ route('settings.update', $settings[0]->id) }}">
            {{ csrf_field() }}
             <div class="form-group">
                <label for="inputName">Refund Amount(In KWD)</label>
                <input type="text" id="amount" class="form-control" value="{{ $settings[0]->value }}" name="amount">
                @error('amount')
                <div class="form-error">{{ $message }}</div>
                @enderror
              </div>

              
              <div class="form-group">
                <button type="submit" class="btn btn-success">Save</button>
              </div> 
              
             </div>  
              
            </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-3">
         </div>
   </div>
        @endsection
        