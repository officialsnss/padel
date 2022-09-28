@extends('backend.layouts.app')
@section('content')
    <div class="row">
         <div class="col-md-3">
         </div> 
        <div class="col-md-6">
          <div class="card card-primary">
           
            <div class="card-body reset-form">
         <form method="post" action="{{ route('amenity.update', $amenitityData->id) }}" enctype="multipart/form-data" id="amenity-form">
            {{ csrf_field() }}
           
            <div class="form-group">
                <label for="inputName">Name</label>
                <textarea id="amenity" class="form-control" name="amenity">{{ $amenitityData->name }}</textarea>
               @error('amenity')
                <div class="form-error">{{ $message }}</div>
               @enderror
              </div>

              <div class="form-group">
                <label for="inputName">Arabic Name</label>
                <textarea id="name_arabic" class="form-control" name="name_arabic">{{ $amenitityData->name_arabic }}</textarea>
               @error('name_arabic')
                <div class="form-error">{{ $message }}</div>
               @enderror
              </div>


              <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                    <label for="inputName">Icon Image</label><br>
                    <input id="fileUpload" type="file" name="icon_image"><br />
                    <div id="image-holder"> 
                         @if($amenitityData->image)
                            <img src="{{ URL::to('/') }}/Images/amenities/{{ $amenitityData->image }}" class="thumb-image">
                         @endif
                    </div>
                </div>
              </div>
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
        