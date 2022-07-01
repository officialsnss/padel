@extends('backend.layouts.app')
@section('content')
    <div class="row">
        
        <div class="col-md-12">
          <div class="card card-primary">
           
            <div class="card-body reset-form">
         <form method="post" action="{{ route('page.update', $pageData[0]->id) }}">
            {{ csrf_field() }}
             <div class="form-group">
                <label for="inputName">Title</label>
                <input type="text" id="title" class="form-control" value="{{ $pageData[0]->title }}" name="title">
                @error('title')
                <div class="form-error">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
               
                <label for="inputName">Content</label>
                <textarea id="content" class="ckeditor form-control" name="content">{{ $pageData[0]->content }}</textarea>
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
        