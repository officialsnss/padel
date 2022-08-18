@extends('backend.layouts.app')
@section('content')
    <div class="row">
        
        <div class="col-md-12">
          <div class="card card-primary">
           
      <div class="card-body reset-form">
         <form method="post" action="{{ route('user.add') }}" id="vendorform">
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
               <div class="form-group col-md-6">
                <label for="inputName">Email</label>
                <input type="text" id="Email" class="form-control" value="" name="email">
                @error('email')
                <div class="form-error">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="inputName">Club Name</label>
                <input type="text" id="clubname" class="form-control" value="" name="clubname">
                @error('clubname')
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
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="inputName">Commission(In Percent on each product)</label>
                          <input type="text" id="commission" class="form-control" value="" name="commission">
                              @error('commission')
                                <div class="form-error">{{ $message }}</div>
                              @enderror
                       </div>
                    </div>   
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="inputName">Service Charge</label>
                            <div class="row">
                              <div class="col-md-10">
                              <input type="text" id="service_charge" class="form-control" value="" name="service_charge">
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
                              <input type="text" id="single_price" class="form-control" value="" name="single_price">
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
                              <input type="text" id="double_price" class="form-control" value="" name="double_price">
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
                          <label for="inputName">Total Indoor Courts</label>
                          <input type="text" id="indoor_courts" class="form-control" value="" name="indoor_courts">
                              @error('indoor_courts')
                                <div class="form-error">{{ $message }}</div>
                              @enderror
                      </div>
                     </div> 
                     <div class="col-md-6">
                        <div class="form-group">
                          <label for="inputName">Total Outdoor Courts</label>
                          <input type="text" id="outdoor_courts" class="form-control" value="" name="outdoor_courts">
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
                          <input type="text" id="latitude" class="form-control" value="" name="latitude">
                              @error('latitude')
                                <div class="form-error">{{ $message }}</div>
                              @enderror
                      </div>
                     </div> 
                     <div class="col-md-6">
                        <div class="form-group">
                          <label for="inputName">Longitude</label>
                          <input type="text" id="longitude" class="form-control" value="" name="longitude">
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
                              <option value="{{$country->id}}">{{$country->name}}</option>
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
                          <input type="text" id="address" class="form-control" value="" name="address">
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
                          <input type="text" id="zipcode" class="form-control" value="" name="zipcode">
                              @error('zipcode')
                                <div class="form-error">{{ $message }}</div>
                              @enderror
                      </div>

                      <div class="form-group">
                          <label for="inputName">Amenities</label><br>
                          <ul class="amenity-list">
                           
                            @foreach($amenities as $amenity)
                             
                            
                            <li>
                            <input type="checkbox" id="amenities" name="amenities[]" value="{{ $amenity->id }}">
                            <label for="{{ $amenity->name }}" style="font-weight:400">{{ $amenity->name }}</label>
                            </li>
                            @endforeach
                         </ul>
                          @error('amenities')
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
                    <div class="col-md-12">
                      <div class="form-group">
                            <label for="inputName">Description</label>
                            <textarea id="description" class="ckeditor form-control" name="description"></textarea>
                                @error('description')
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
        url: APP_URL+"/admin/users/get-user-region",
        type: "GET",
        data: {
        country_id: country_id,
       // id:id
        },
        cache: false,
        success: function(result){
          
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
       url: APP_URL+"/admin/users/get-user-city",
       type: "GET",
       data: {
        region_id: region_id,
      //  id:id
       },
       cache: false,
       success: function(result){
        
       $("#city_name").html(result);
    
       }
     });
      });
     
      
    }); 

  
  </script>
        @endsection
        