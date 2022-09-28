@extends('backend.layouts.app')
@section('content')
    <div class="row">
       <div class="col-md-12">
          <div class="card card-primary">
           
            <div class="card-body reset-form">
         <form method="post" action="{{ route('bat.update', $batData->id)}}" id="batform" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="row">
            <div class="col-md-6"> 
              <div class="form-group">
                  <label for="inputName">Bat Name</label>
                  <input type="text" id="bat_name" class="form-control" value="{{ $batData->name }}" name="bat_name">
                  @error('bat_name')
                  <div class="form-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-6"> 
              <div class="form-group">
                  <label for="inputName">Arabic Name</label>
                  <input type="text" id="name_arabic" class="form-control" value="{{ $batData->name_arabic }}" name="name_arabic">
                  @error('name_arabic')
                  <div class="form-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
          </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                    <label for="inputName">Featured Image</label><br>
                    <input id="fileUpload" type="file" name="featured_image"><br />
                    <div id="image-holder"> 
                         @if($batData->featured_image)
                            <img src="{{ URL::to('/') }}/Images/bat_images/{{ $batData->featured_image }}" class="thumb-image">
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
                <textarea id="desc" class="ckeditor form-control" value="" name="desc">{{ $batData->description }}</textarea>
               @error('desc')
                <div class="form-error">{{ $message }}</div>
               @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                <label for="inputName">Arabic Description</label>
                <textarea id="desc_arabic" class="ckeditor form-control" value="" name="desc_arabic">{{ $batData->desc_arabic }}</textarea>
               @error('desc_arabic')
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
              
             </div>  
            </form> 
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
     </div>

   
        @endsection
        