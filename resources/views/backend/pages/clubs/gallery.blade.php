@extends('backend.layouts.app')
@section('content')
    <div class="row">
      <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-body reset-form">
            <form method="post" id="upload_image" action="{{ route('club.image.save', $clubId) }}" enctype="multipart/form-data">
    @csrf

        <div class="row" style="margin-top: 30px;">
            <div class="col-sm-10">
                <label class="select-image">
                <span class="upload-text">Upload Images</span>
                  <input type="file" class="image-file" multiple="" required="" accept="image/png, image/jpeg">
                </label>
            </div>
            <div class="col-sm-2">
                <button type="submit" name="submit" class="btn btn-primary upload-image">Upload</button>
            </div>
            </div>
          
        <div class="row" style="margin-top: 20px;"  id="mul-img">
        <div class="place-text">Uploaded Images Comes Here...</div>
        <span id="selected-images">

         
        </span>
       
        </div>
      
        @if($clubImages)

       
          
         
         <div class="row" style="margin-top: 20px;"  id="old-images">
          <div class="col-md-12">
            <h3 class="gallery-ttile">Uploaded Images</h3>
           </div>
            @foreach($clubImages as $clubimage)
              <div class="pip col-sm-3 col-4 boxDiv" align="center" style="margin-bottom: 20px;">
                  <img style="width: 150px; height: 130px;" src="{{ URL::to('/') }}/Images/club_images/{{$clubimage->image}}" class="prescriptions">
                  <p class="imageremove"><a href="{{ route('club.image.delete', $clubimage->id )}}" class="btn btn-danger">Delete</a></p>
                 </div>
          @endforeach
          </div>
        @endif
        
            </form>  
            </div>
          </div>
      </div>
    </div>

 
    <script type="text/javascript">
      $(document).ready(function() {
          
        if (window.File && window.FileList && window.FileReader) 
        {
          $(".image-file").on("change", function(e) 
          {
            $('.place-text').hide();
            var file = e.target.files,
            imagefiles = $(".image-file")[0].files;
            var i = 0;
            $.each(imagefiles, function(index, value){
              var f = file[i];
              var fileReader = new FileReader();
              fileReader.onload = (function(e) {

                $('<div class="pip col-sm-3 col-4 boxDiv" align="center" style="margin-bottom: 20px;">' +
                  '<img style="width: 150px; height: 130px;" src="' + e.target.result + '" class="prescriptions">'+
                  '<p style="word-break: break-all;">' + value.name + '</p>'+
                  '<p class="cross-image remove">Remove</p>'+
                  '<input type="hidden" name="image[]" value="' + e.target.result + '">' +
                  '<input type="hidden" name="imageName[]" value="' + value.name + '">' +
                  '</div>').insertAfter("#selected-images");
                  $(".remove").click(function(){
                    $(this).parent(".pip").remove();
                  });
              });
              fileReader.readAsDataURL(f);
              i++;
            });
          });
        } else {
          alert("Your browser doesn't support to File API")
        }
      });
</script>

<script>
    $('document').ready(function(e){
      $('.upload-image').click(function(e){
         var imageDiv = $(".boxDiv").length; 
         if(imageDiv == ''){
           alert('Please upload image'); // Check here image selected or not
           return false;
         }
       
      });
    });
</script>

        @endsection

        