@extends('backend.layouts.app')
@section('content')
    <div class="row">
      <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-body reset-form">
              <form method="post" action="{{ route('club.update', $clubData->id) }}" id="club-edit" enctype="multipart/form-data">
                  {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="inputName">Title</label>
                          <input type="text" id="clubname" class="form-control" value="{{ $clubData->name }}" name="clubname">
                              @error('clubname')
                                <div class="form-error">{{ $message }}</div>
                              @enderror
                       </div>
                    </div>   
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="inputName">Service Charge</label>
                            <div class="row">
                              <div class="col-md-10">
                              <input type="text" id="service_charge" class="form-control" value="{{ $clubData->service_charge }}" name="service_charge">
                              </div>
                              <div class="col-md-2">
                                <input type="text" class="form-control" value="{{ $clubData->code }}" readonly>
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
                              <input type="text" id="single_price" class="form-control" value="{{ $clubData->single_price }}" name="single_price">
                              </div>
                              <div class="col-md-2">
                                <input type="text" class="form-control" value="{{ $clubData->code }}" readonly>
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
                              <input type="text" id="double_price" class="form-control" value="{{ $clubData->double_price }}" name="double_price">
                              </div>
                              <div class="col-md-2">
                                <input type="text" class="form-control" value="{{ $clubData->code }}" readonly>
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
                          <input type="text" id="indoor_courts" class="form-control" value="{{ $clubData->indoor_courts }}" name="indoor_courts">
                              @error('indoor_courts')
                                <div class="form-error">{{ $message }}</div>
                              @enderror
                      </div>
                     </div> 
                     <div class="col-md-6">
                        <div class="form-group">
                          <label for="inputName">Total Outdoor Courts</label>
                          <input type="text" id="outdoor_courts" class="form-control" value="{{ $clubData->outdoor_courts }}" name="outdoor_courts">
                              @error('outdoor_courts')
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
                              <option value="{{$country->id}}" {{ ($country->id ==  $clubData->country)?'selected':'' }}>{{$country->name}}</option>
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
                          <input type="text" id="address" class="form-control" value="{{ $clubData->address }}" name="address">
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
                          <input type="text" id="zipcode" class="form-control" value="{{ $clubData->zipcode }}" name="zipcode">
                              @error('zipcode')
                                <div class="form-error">{{ $message }}</div>
                              @enderror
                      </div>

                      <div class="form-group">
                          <label for="inputName">Amenities</label><br>
                          <ul class="amenity-list">
                            <?php $amenitiesList = $clubData->amenities;
                                   $amenitiesArr = explode(',',  $amenitiesList);
                            ?>
                            @foreach($amenities as $amenity)
                             <?php if(in_array($amenity->id, $amenitiesArr)){
                                 $checked = 'checked';
                             }
                             else{
                              $checked = '';
                             } ?>
                            <li>
                            <input type="checkbox" id="amenities" name="amenities[]" value="{{ $amenity->id }}" {{ $checked }}>
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
                         @if($clubData->featured_image)
                            <img src="{{ URL::to('/') }}/Images/club_images/{{ $clubData->featured_image }}" class="thumb-image">
                         @endif
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
                            <textarea id="description" class="ckeditor form-control" name="description">{{ $clubData->description }}</textarea>
                                @error('description')
                                <div class="form-error">{{ $message }}</div>
                                @enderror
                      </div> 
                    </div>  
                  </div>  
                  <div class="row">
                     <div class="col-md-12">
                     <div class="form-group">
                         <button type="submit" class="btn btn-success">Save</button>
                      </div> 
                     </div>
                  </div>
              </form>
            </div>
          </div>
      </div>
    </div>
<input type="hidden" value="{{ $clubData->id }}" id="clubid">
    
  <script>
    var APP_URL = {!! json_encode(url('/')) !!}
      
    $(document).ready(function() {
       $('#country_name').bind('change', function() {
       var id = $('#clubid').val();
      // alert(id);
       var country_id = this.value;
       $.ajax({
        url: APP_URL+"/admin/get-region",
        type: "GET",
        data: {
        country_id: country_id,
        id:id
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
      var id = $('#clubid').val();
       $.ajax({
       url: APP_URL+"/admin/get-city",
       type: "GET",
       data: {
        region_id: region_id,
        id:id
       },
       cache: false,
       success: function(result){
        
       $("#city_name").html(result);
     //  $('#city_name').html('<option value="">Select Region First</option>'); 
       }
     });
      });
     
      
    }); 

  
  </script>

        @endsection

        