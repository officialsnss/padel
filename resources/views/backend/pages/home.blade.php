@extends('backend.layouts.app')

@section('content')


   
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
 @if ( auth()->user()->role != '5' && auth()->user()->role != '4')          
        <div class="row">

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{  $regUsers }}</h3>

                <p>Users Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{url('/admin/users/customers')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $regClubs }}</h3>

                <p>Total Clubs Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{url('/admin/clubs')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $totalBooking }}</h3>

                <p>Total Booking</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{url('/admin/bookings')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $todayBooking }}</h3>

                <p>Today's Booking</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{url('/admin/bookings')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
@endif
@if ( auth()->user()->role != '5' &&  auth()->user()->role != '4')  
        <!-- .row -->
      <div class="row" {{  auth()->user()->role }}>
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $sale }} KWD</h3>

                <p>Today's sale</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{url('/admin/bookings')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $cancel }}</h3>

                <p>Cancellation</p>
              </div>
              <div class="icon">
                <i class="ion ion-alert"></i>
              </div>
              <a href="{{url('/admin/refunds')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $refund }}</h3>

                <p>Refunds Pending</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{url('/admin/refunds')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        @endif
        <!-- .row -->
        <!-- Court Owner Dashbored -->
        <!-- .row -->
  @if ( auth()->user()->role == '5')  
      <div class="row">
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $sale }} KWD</h3>

                <p>Today's sale</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{url('/admin/bookings')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $totalBooking }}</h3>

                <p>Total Bookings</p>
              </div>
              <div class="icon">
                <i class="ion ion-alert"></i>
              </div>
              <a href="{{url('/admin/bookings')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $todayBooking }}</h3>

                <p>Today's Booking</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{url('/admin/bookings')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- .row -->

<!--  End Of Court Owner Dashbored -->

 @endif

 @if ( auth()->user()->role == '4')  
 <div class="row">
       
   <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $totalBooking }}</h3>

                <p>Total Bookings</p>
              </div>
              <div class="icon">
                <i class="ion ion-alert"></i>
              </div>
              <a href="{{url('/admin/bookings')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4  col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $todayBooking }}</h3>

                <p>Today's Booking</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{url('/admin/bookings')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- .row -->

 @endif
        <!-- .row -->
      <div class="row">
      <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                <i class="ion ion-grid"></i>
                  New booked items
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                <table style="width:100%">
                <thead>
                  <tr>
                     <th>S.no</th>
                     @if(auth()->user()->role == 5)
                     <th>Player Name</th>
                     <th>Email</th>
                     @else
                     <th>Club Name</th>
                     @endif
                      <th>Amount</th>
                 </tr>
                </thead>
                  <?php
                  $i = 1; 
                 foreach($topBooking as $data) {
                 // dd($data); ?>
                       <tr>
                      <td>{{  $i }}</td>
                      <td>{{$data->clubname}}</td>
                       @if(auth()->user()->role == 5)
                      <td>{{ $data->playeremail}}</td>
                      @endif 
                      <td>{{ $data->total_amount}} KWD</td>
                      </tr>
                    
                 <?php   $i++;  }

                       ?>
                       </table>
                
                </div>
              </div><!-- /.card-body -->
            </div>
      </div>

             

            

            
          

            
          
          
     
@endsection