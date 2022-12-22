@extends('frontend.layouts.app')

@section('content')
<div class="page">
    <div class="mid-area-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center mb-3">Change Password</h1>
                </div>
                <form action="{{route('updatePassword')}}" method="post">
                    @csrf
                    <div class="col-lg-6 col-md-6 col-sm-6 offset-lg-3 offset-md-3">
                    <div class="text-danger"><p>@if($errors->all() != []){{$errors->getMessages()[0][0]}}@endif</p></div>

                        <div class="form-box">
                            <div class="form-control-group">
                                <input type="text" name="old_password" class="form-control" placeholder="Old Password" />
                            </div>
                            <div class="form-control-group">
                                <input type="password" name="new_password" class="form-control" placeholder="New Password" />
                            </div>
                            <div class="form-control-group">
                                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" />
                            </div>
                            <div class="form-control-group">
                                <button type="submit" class="btn button w-100 pt-2 pb-2">Change Password</button>
                            </div>
                        </div>
                    </div>
                </form>



            </div>

        </div>
    </div>
</div>
@endsection