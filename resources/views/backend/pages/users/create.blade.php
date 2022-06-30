@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
          <div class="card card-primary">
           
            <div class="card-body reset-form">
         <form method="post" action="{{ route('user.add') }}">
            {{ csrf_field() }}
          <div class="row">  
            
              <div class="form-group col-md-6">
                <label for="inputName">Full Name</label>
                <input type="text" id="fullname" class="form-control" value="" name="fullname">
                @error('fullname')
                <div class="form-error">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label for="inputName">Phone Number</label>
                <input type="text" id="phone" class="form-control" value="" name="phone">
               @error('phone')
                <div class="form-error">{{ $message }}</div>
               @enderror
              </div>
             </div>  
             <div class="row"> 
               <div class="form-group col-md-12">
                <label for="inputName">Email</label>
                <input type="text" id="Email" class="form-control" value="" name="email">
                @error('email')
                <div class="form-error">{{ $message }}</div>
                @enderror
              </div>
             </div>
             <div class="row">
               <div class="form-group col-md-6">
                <label for="newPassword">New Password</label>
                <input type="password" id="password" class="form-control" value="" name="password">
                @error('password')
                <div class="form-error">{{ $message }}</div>
               @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="password_confirmation" class="form-control" value=""  name="password_confirmation">
                @error('password_confirmation')
                <div class="form-error">{{ $message }}</div>
               @enderror
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
        <div class="col-md-2">
         </div>
   </div>
        @endsection
        