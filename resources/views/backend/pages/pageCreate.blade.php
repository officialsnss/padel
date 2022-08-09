@extends('backend.layouts.app')
@section('content')
    <div class="row">
        
        <div class="col-md-12">
          <div class="card card-primary">
           
            <div class="card-body reset-form">
         <form method="post" action="{{ route('page.add') }}">
            {{ csrf_field() }}
             <div class="form-group">
                <label for="inputName">Title</label>
                <input type="text" id="title" class="form-control" value="" name="title">
                @error('title')
                <div class="form-error">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="inputName">Content</label>
                <textarea id="content" class="ckeditor form-control" value="" name="content"></textarea>
               @error('content')
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
       
   </div>
        @endsection
        