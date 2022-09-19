@extends('backend.layouts.app')
@section('content')
    <div class="row">
       <div class="col-md-12">
          <div class="card card-primary">
           
            <div class="card-body reset-form">
         <form method="post" action="{{ route('coach.update', $coachData->cid)}}" id="coachform" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="row">
            <div class="col-md-6"> 
              <div class="form-group">
                  <label for="inputName">Coach Name</label>
                  <input type="text" id="coach_name" class="form-control" value="{{ $coachData->name }}" name="coach_name">
                  @error('coach_name')
                  <div class="form-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-6"> 
              <div class="form-group">
                  <label for="inputName">Email</label>
                  <input type="email" id="coach_email" class="form-control" value="{{ $coachData->email }}" name="coach_email">
                  @error('coach_email')
                  <div class="form-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
          </div>
         
          <div class="row">
            <div class="col-md-6"> 
              <div class="form-group">
                  <label for="inputName">Total Experience</label>
                  <input type="text" id="experience" class="form-control" value="{{ $coachData->experience }}" name="experience">
                  @error('experience')
                  <div class="form-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-6"> 
              <div class="form-group">
                  <label for="inputName">Price(Per/hour)</label>
                      <div class="row">
                              <div class="col-md-10">
                              <input type="text" id="price" class="form-control" value="{{ $coachData->price }}" name="price">
                              </div>
                              <div class="col-md-2">
                                <input type="text" class="form-control" value="KWD" readonly>
                              </div>
                      </div>   
                  @error('price')
                  <div class="form-error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
          </div>

            <div class="row">
              <div class="col-md-6">
                 <div class="form-group">
                    <label for="inputName">Assign Clubs</label><br>
                     <select class="selectpicker" multiple data-live-search="true" name="assign_club[]">
                     <?php $lists = $coachData->clubs_assigned;
                         $idList =  explode(',', $lists);
                       
                      ?>
                      @foreach($clubs as $key => $value)
                       
                        <option value="{{ $key }}" {{ (in_array($key, $idList))?'selected':'' }}>{{ $value }}</option>
                      @endforeach
                    </select>
                     @error('assign_club')
                      <div class="form-error">{{ $message }}</div>
                      @enderror
                </div>
               
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="inputName">Profile Picture</label><br>
                    <input id="fileUpload" type="file" name="profile_img"><br />
                    <div id="image-holder"> 
                    @if($coachData->profile_pic)
                            <img src="{{ URL::to('/') }}/Images/user_Images/{{ $coachData->profile_pic }}" class="thumb-image">
                         @endif
                    </div>
                    @error('profile_img')
                      <div class="form-error">{{ $message }}</div>
                      @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                <label for="inputName">About Coach</label>
                <textarea id="desc" class="ckeditor form-control" name="desc">{{ $coachData->description }}</textarea>
               @error('desc')
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

     <script type="text/javascript">
    $(document).ready(function() {
        $('select').selectpicker();
    });
     </script>
        @endsection
        