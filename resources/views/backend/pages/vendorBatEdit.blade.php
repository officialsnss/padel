@extends('backend.layouts.app')
@section('content')
    <div class="row">
       <div class="col-md-12">
          <div class="card card-primary">
           
            <div class="card-body">
         <form method="post" action="{{ route('vendor.update', $batData->id) }}" id="vendorcreateform" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="row">
            <div class="col-md-12"> 
              <div class="form-group">
                  <label for="inputName">Select Bat</label>
                  <select id="bat_id" class="form-control" name="bat_id">
                    <option value="" >Select Bat</option>
                      @foreach($bats as $bat)
                         <option value="{{ $bat->id }}" {{ ($batData->bat_id  == $bat->id)?'selected':'' }}>{{ $bat->name }}</option>
                      @endforeach
                    </select>
                  @error('bat_id')
                  <div class="form-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
          </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="inputName">Price(Per Hour)</label><br>
                    <input type="text" id="price" class="form-control" value="{{ $batData->price }}" name="price">
                     @error('price')
                      <div class="form-error">{{ $message }}</div>
                      @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="inputName">Quantity</label><br>
                    <input type="number" id="quantity" class="form-control" value="{{ $batData->quantity }}" name="quantity">
                     @error('quantity')
                      <div class="form-error">{{ $message }}</div>
                      @enderror
                </div>
              </div>
            </div>

             <div class="row">
               <div class="col-md-12"> 
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">Update</button>
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
        