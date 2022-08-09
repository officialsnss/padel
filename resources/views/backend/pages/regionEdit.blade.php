@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
          <div class="card card-primary">
           
            <div class="card-body reset-form">
         <form method="post" action="{{ route('region.update', $regionsData->id) }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="inputName">Select Country</label>
                <select id="country" name="country_name" class="form-control">
                  <option value="">---Select Country---</option>
                    @foreach ($countries as $country)
                    <option value="{{$country->id}}" {{ ($regionsData->country_id  == $country->id)?'selected':''}}>{{$country->name}}</option>
                    @endforeach
                </select>
                @error('country_name')
                <div class="form-error">{{ $message }}</div>
                @enderror
              </div>

             <div class="form-group">
                <label for="inputName">Region Name</label>
                <input type="text" id="region" class="form-control" value="{{ $regionsData->name}}" name="region">
                @error('region')
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
        <div class="col-md-3">
        </div>
   </div>
        @endsection
        