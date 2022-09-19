@extends('backend.layouts.app')
@section('content')
    <div class="row">
       <div class="col-md-12">
          <div class="card card-primary">
           
            <div class="card-body reset-form">
         <form method="post" action="{{ route('holiday.add') }}" id="holidaysform" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="row">
            <div class="col-md-6"> 
              <div class="form-group">
                  <label for="inputName">Start Date</label>
                  <input type="date" id="start_date" class="form-control" value="" name="start_date" min="<?php echo date("Y-m-d"); ?>">
                  @error('start_date')
                  <div class="form-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-6"> 
              <div class="form-group">
                  <label for="inputName">End Date</label>
                  <input type="date" id="end_date" class="form-control" value="" name="end_date" min="<?php echo date("Y-m-d"); ?>">
                  @error('end_date')
                  <div class="form-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
          </div>
         
     
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                <label for="inputName">Reason</label>
                <textarea id="reason" class="form-control" name="reason"></textarea>
               @error('reason')
                <div class="form-error">{{ $message }}</div>
               @enderror
                </div>
              </div>
            </div>
             

             <div class="row">
               <div class="col-md-12"> 
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">Appy</button>
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
        