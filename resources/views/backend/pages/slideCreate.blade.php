@extends('backend.layouts.app')
@section('content')
    <div class="row">
       <div class="col-md-12">
          <div class="card card-primary">

            <div class="card-body reset-form">
         <form method="post" action="{{ route('slide.add') }}" id="slideform" enctype="multipart/form-data">
            {{ csrf_field() }}

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label for="inputName">Slide Heading</label>
                  <textarea id="s-heading" class="form-control" value="" name="slide_heading"></textarea>
                  @error('slide_heading')
                  <div class="form-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
          </div>
           <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                  <label for="inputName">Button Label</label>
                  <input type="text" id="button-label" class="form-control" value="" name="button_label">
                  @error('button_label')
                  <div class="form-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
                  <label for="inputName">Button Value</label>
                  <input type="text" id="button-val" class="form-control" value="" name="button_val">
                  @error('button_val')
                  <div class="form-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
          </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                    <label for="inputName">Banner Image</label><br>
                    <input id="fileUpload" type="file" name="image"><br />
                    <div id="image-holder"> <img src="" class="thumb-image"> </div>
                    @error('image')
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
