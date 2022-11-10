@extends('backend.layouts.app')
@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="card card-primary">

                <div class="card-body reset-form">
                    <form method="post" action="{{ route('user.add') }}" id="vendorform" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="inputName">Full Name</label>
                                <input type="text" id="fullname" class="form-control" value="{{ old('fullname') }}"
                                    name="fullname">
                                @error('fullname')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputName">Arabic Name</label>
                                <input type="text" id="full_name_arabic" class="form-control"
                                    value="{{ old('full_name_arabic') }}" name="full_name_arabic">
                                @error('full_name_arabic')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputName">Email</label>
                                <input type="text" id="Email" class="form-control" value="{{ old('email') }}"
                                    name="email">
                                @error('email')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputName">Phone Number</label>
                                <input type="text" id="phone" class="form-control" value="{{ old('phone') }}"
                                    name="phone">
                                @error('phone')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputName">Club Name</label>
                                <input type="text" id="clubname" class="form-control" value="{{ old('clubname') }}"
                                    name="clubname">
                                @error('clubname')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputName">Arabic Club Name</label>
                                <input type="text" id="name_arabic" class="form-control"
                                    value="{{ old('name_arabic') }}" name="name_arabic">
                                @error('name_arabic')
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
                                <input type="password" id="password_confirmation" class="form-control" value=""
                                    name="password_confirmation">
                                @error('password_confirmation')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Price for Singles</label>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input type="text" id="single_price" class="form-control"
                                                value="{{ old('single_price') }}" name="single_price">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" value="KWD" readonly>
                                        </div>
                                    </div>
                                    @error('single_price')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Price for Doubles</label>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input type="text" id="double_price" class="form-control"
                                                value="{{ old('double_price') }}" name="double_price">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" value="KWD" readonly>
                                        </div>
                                    </div>
                                    @error('double_price')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Club Opening Time</label>
                                    <input type="text" id="start_time" class="form-control timePicker"
                                        value="{{ old('start_time') }}" name="start_time">
                                    @error('start_time')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Club Closing Time</label>
                                    <input type="text" id="end_time" class="form-control timePicker"
                                        value="{{ old('end_time') }}" name="end_time">
                                    @error('end_time')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Total Indoor Courts</label>
                                    <input type="text" id="indoor_courts" class="form-control"
                                        value="{{ old('indoor_courts') }}" name="indoor_courts">
                                    @error('indoor_courts')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Total Outdoor Courts</label>
                                    <input type="text" id="outdoor_courts" class="form-control"
                                        value="{{ old('outdoor_courts') }}" name="outdoor_courts">
                                    @error('outdoor_courts')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Latitude</label>
                                    <input type="text" id="latitude" class="form-control"
                                        value="{{ old('latitude') }}" name="latitude">
                                    @error('latitude')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Longitude</label>
                                    <input type="text" id="longitude" class="form-control"
                                        value="{{ old('longitude') }}" name="longitude">
                                    @error('longitude')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Select Country</label>
                                    <select id="country_name" name="country" class="form-control">
                                        <option value="">---Select Country---</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }} -
                                                {{ $country->name_arabic }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_name')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Address</label>
                                    <input type="text" id="address" class="form-control"
                                        value="{{ old('address') }}" name="address">
                                    @error('address')
                                        <div class="form-error">{{ $address }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Select Region</label>
                                    <select id="region_name" name="region_id" class="form-control">
                                        <option value="">Select country first</option>
                                    </select>
                                    @error('region_name')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Select City</label>
                                    <select id="city_name" name="city_id" class="form-control">
                                        <option value="">Select region first</option>
                                    </select>
                                    @error('city_name')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Zip Code</label>
                                    <input type="text" id="zipcode" class="form-control"
                                        value="{{ old('zipcode') }}" name="zipcode">
                                    @error('zipcode')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Service Charge</label>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input type="text" id="service_charge" class="form-control"
                                                value="{{ old('service_charge') }}" name="service_charge">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" value="KWD" readonly>
                                        </div>
                                    </div>
                                    @error('service_charge')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Commission(In Percent on each product)</label>
                                    <input type="text" id="commission" class="form-control"
                                        value="{{ old('commission') }}" name="commission">
                                    @error('commission')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Featured Image</label><br>
                                    <input id="fileUpload" type="file" name="featured_image"><br />
                                    <div id="image-holder">

                                    </div>
                                    @error('featured_image')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputName">Amenities</label><br>
                                <ul class="amenity-list">

                                    @foreach ($amenities as $amenity)
                                        <li>
                                            <input type="checkbox" id="amenities" name="amenities[]"
                                                value="{{ $amenity->id }}">
                                            <label for="{{ $amenity->name }}"
                                                style="font-weight:400">{{ $amenity->name }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                                @error('amenities')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Club Rating</label><br>
                                    <input id="rating" type="text" name="club_rating"
                                        value="{{ old('club_rating') }}" class="form-control" required><br />
                                    <div id="image-holder">

                                    </div>
                                    @error('club_rating')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputName">Description</label>
                                    <textarea id="description" class="ckeditor form-control" name="description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputName">Arabic Description</label>
                                    <textarea id="description_arabic" class="ckeditor form-control" name="description_arabic">{{ old('description_arabic') }}</textarea>
                                    @error('description_arabic')
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
        var APP_URL = {!! json_encode(url('/')) !!}

        $(document).ready(function() {
            $('#country_name').bind('change', function() {
                //var id = $('#clubid').val();

                var country_id = this.value;

                $.ajax({
                    url: APP_URL + "/admin/users/get-user-region",
                    type: "GET",
                    data: {
                        country_id: country_id,
                        // id:id
                    },
                    cache: false,
                    success: function(result) {

                        $("#region_name").html(result);
                        $('#region_name').trigger('change');
                        $('#city_name').html('<option value="">Select Region First</option>');
                    }

                });
            });

            $('#country_name').trigger('change');



            $('#region_name').bind('change', function() {

                var region_id = this.value;
                //var id = $('#clubid').val();
                $.ajax({
                    url: APP_URL + "/admin/users/get-user-city",
                    type: "GET",
                    data: {
                        region_id: region_id,
                        //  id:id
                    },
                    cache: false,
                    success: function(result) {

                        $("#city_name").html(result);

                    }
                });
            });


        });
    </script>
@endsection
