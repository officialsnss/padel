<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
        
            <h1>{{ $title ?? '' }}</h1>
           
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin/')}}">Admin</a></li>
            
            @foreach(Request::segments() as $segment)
              @if($segment != 'admin')
            <li class="breadcrumb-item">
                <a href="{{url('/admin/'.$segment)}}">{{$segment}}</a>
            </li>
            @endif
            @endforeach
            </ol>
          </div> -->
          
        </div>
      </div><!-- /.container-fluid -->
    </section>