@extends('backend.layouts.app')
@section('content')
    <div class="row">
        
        <div class="col-md-12">
          <div class="card card-primary">
           
            <div class="card-body setting-form">
         <form method="post" action="{{ route('settings.update') }}">
            {{ csrf_field() }}
            @foreach($settings as $setting)
             <div class="form-group">
                @if($setting->label == 'facebook_url')
                  @php  $formlabel = 'Facebook URL'; @endphp
                @elseif($setting->label == 'instagram_url')
                  @php $formlabel = 'Instagram URL' ; @endphp
                @elseif($setting->label == 'twitter_url')
                  @php $formlabel = 'Twitter URL' ; @endphp
                @elseif($setting->label == 'you_tube_url')
                  @php $formlabel = 'You Tube URL' ; @endphp
                @elseif($setting->label == 'linked_in_url')
                  @php $formlabel = 'Linked In URL' ; @endphp
                @elseif($setting->label == 'copyright_text')
                  @php $formlabel = 'Copyright Text' ; @endphp
               @else
                  @php $formlabel = 'Footer Extra Information' ; @endphp
               @endif
                <label for="inputName">{{ $formlabel }}</label>
                <input type="text" class="form-control" value="{{ $setting->value }}" name="setting[{{ $setting->label}}]">
                @error($setting->label)
                <div class="form-error">{{ $message }}</div>
                @enderror
              </div>

             @endforeach 

             
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
        