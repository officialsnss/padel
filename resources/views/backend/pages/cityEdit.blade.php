@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
          <div class="card card-primary">
           
            <div class="card-body reset-form">
         <form method="post" action="{{ route('city.update', $cityData->id) }}" id="cities-form">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="inputName">Select Region</label>
                <select id="region_name" name="region_name" class="form-control">
                  <option value="">---Select Region---</option>
                    @foreach ($regions as $region)
                    
                    <option value="{{$region->id}}" {{ ($cityData->region_id  == $region->id)?'selected':'' }}>{{$region->name}} - {{ $region->name_arabic }} ( {{$region->cname }} - {{ $region->aname}} )</option>
                    @endforeach
                </select>
                @error('region_name')
                <div class="form-error">{{ $message }}</div>
                @enderror
              </div>

             <div class="form-group">
                <label for="inputName">City Name</label>
                <input type="text" id="city" class="form-control" value="{{$cityData->name  }}" name="city">
                @error('city')
                <div class="form-error">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="inputName">Arabic City Name</label>
                <input type="text" id="arabic_city" class="form-control" value="{{$cityData->name_arabic }}" name="arabic_city">
                @error('arabic_city')
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
        