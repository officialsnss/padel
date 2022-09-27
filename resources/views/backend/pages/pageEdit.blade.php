@extends('backend.layouts.app')
@section('content')
    <div class="row">
        
        <div class="col-md-12">
          <div class="card card-primary">
           
            <div class="card-body reset-form">
         <form method="post" action="{{ route('page.update', $pageData->id) }}" id="cms-pages">
            {{ csrf_field() }}
          <div class="row">
            <div class="col-md-6">
             <div class="form-group">
                <label for="inputName">Title</label>
                <input type="text" id="title" class="form-control" value="{{ $pageData->title }}" name="title">
                @error('title')
                <div class="form-error">{{ $message }}</div>
                @enderror
              </div>
           </div>
          
           <div class="col-md-6">
             <div class="form-group">
                <label for="inputName">Arabic Title</label>
                <input type="text" id="title_arabic" class="form-control" value="{{ $pageData->title_arabic }}" name="title_arabic">
                @error('title_arabic')
                <div class="form-error">{{ $message }}</div>
                @enderror
              </div>
           </div>
           </div>
       
              <div class="form-group">
               
                <label for="inputName">Content</label>
                <textarea id="content" class="ckeditor form-control" name="content">{{ $pageData->content }}</textarea>
               @error('content')
                <div class="form-error">{{ $message }}</div>
               @enderror
              </div>

              <div class="form-group">
               
                <label for="inputName"> Arabic  Content</label>
                <textarea id="content_arabic" class="ckeditor form-control" name="content_arabic">{{ $pageData->content_arabic }}</textarea>
               @error('content_arabic')
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
        