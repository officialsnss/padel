@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
          <div class="card card-primary">

            <div class="card-body reset-form">

            <form method="post" action="{{ route('coach.newPassword',$userId)}}">
            {{ csrf_field() }}
              <div class="form-group">
                <label for="inputName">Email</label>
                <input type="email" id="Email" class="form-control" value="{{ $userEmail }}" name="email" readonly>
              </div>

              <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" id="password" class="form-control" value="" name="password">
                @error('password')
                <div class="form-error">{{ $message }}</div>
               @enderror
              </div>
              <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="password_confirmation" class="form-control" value=""  name="password_confirmation">
                @error('password_confirmation')
                <div class="form-error">{{ $message }}</div>
               @enderror
              </div>
              <div class="form-group">

                <button type="submit" class="btn btn-success">Save Changes</button>

        </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-3">
        </div>
   </div>
        @endsection
