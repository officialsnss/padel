<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ URL::to('/'); }}" class="brand-link">
      <img src="{{asset('assets/backend/img/AdminLTELogo.png')}}" alt="Sports Arena" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sports Arena</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
     @if(auth()->user()->role == '5')
     <!-- Sidebar user panel (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
     <div class="image">
          <i class="fas fa-table-tennis"></i>
      </div>
       <div class="info">
       <?php   $userId = auth()->user()->id; 
        $res =  \App\Models\Club::where(['user_id' => $userId])->pluck('name')->first();
        ?>
         <a>{{ $res }}</a>
        </div>
      </div>
    @endif
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="{{url('admin/dashboard')}}" class="nav-link {{ (request()->segment(2) == 'dashboard') || (request()->segment(2) == '') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if ( auth()->user()->role == '1' || auth()->user()->role == '2')
            
          <li class="nav-item">
            <a href="#" class="nav-link {{ ((request()->segment(3) == 'customers') || (request()->segment(3) == 'court-owners') || (request()->segment(2) == 'users'))? 'active' : '' }}">
              <i class="nav-icon 	fas fa-users"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/admin/users/customers')}}" class="nav-link  {{ (request()->segment(3) == 'customers') ? 'active' : '' }}">
                  <i class="fas fa-user-tie nav-icon"></i>
                  <p>Customers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/users/court-owners')}}" class="nav-link {{ (request()->segment(3) == 'court-owners') ? 'active' : '' }}">
                  <i class="fas fa-user-graduate nav-icon"></i>
                  <p>Court Owners</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{url('/admin/bookings')}}" class="nav-link  {{ (request()->segment(2) == 'bookings' || request()->segment(2) == 'calendar' || (request()->segment(3) == 'view' &&  request()->segment(2) == 'booking' )) ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-edit"></i>
              <p>
                Bookings
              </p>
            </a>
          </li>
          
          @if ( auth()->user()->role == '5')   
          
           <li class="nav-item">
            <a href="{{url('/admin/outside-booking')}}" class="nav-link  {{ (request()->segment(2) == 'outside-booking') ? 'active' : '' }}">
            <i class="nav-icon fas fa-box-open"></i>
              <p>
                Outside Bookings
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link  {{ (request()->segment(2) == 'clubs' || request()->segment(3) == 'timeslots') ? 'active' : '' }}">
            <i class="nav-icon 	fas fa-building"></i>
              <p>
                Club
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
               <a href="{{url('/admin/clubs')}}" class="nav-link  {{ request()->segment(2) == 'clubs' ? 'active' : '' }}">
                <i class="nav-icon fas fa-info-circle"></i>
                <p>
                  Details
                  
                </p>
                </a>
              </li>
              <!--<li class="nav-item">-->
              <!--  <a href="{{url('/admin/club/timeslots')}}" class="nav-link  {{ (request()->segment(3) == 'timeslots' && request()->segment(4) != 'book') ? 'active' : '' }}">-->
              <!--    <i class="fas fa-clock nav-icon"></i>-->
              <!--    <p>Timeslots</p>-->
              <!--  </a>-->
              <!--</li>-->

              <li class="nav-item">
                <a href="{{url('/admin/club/timeslots/book')}}" class="nav-link  {{ (request()->segment(4) == 'book') ? 'active' : '' }}">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Book Timeslots</p>
                </a>
              </li>
             
          
            </ul>
          </li> 
         

          <li class="nav-item">
            <a href="{{url('/admin/vendor/bats')}}" class="nav-link  {{ request()->segment(2) == 'vendor' ? 'active' : '' }}">
            <i class="nav-icon 	fas fa-table-tennis"></i>
              <p>
                Bats </p>
            </a>
          </li>  
       
          @endif
          
      
          @if ( auth()->user()->role == '1' || auth()->user()->role == '2')
          <li class="nav-item">
            <a href="{{url('/admin/clubs-listing/')}}" class="nav-link  {{ (request()->segment(2) == 'clubs-listing') ? 'active' : '' }}">
            <i class="nav-icon 	fas fa-building"></i>
              <p>
                Clubs
               
              </p>
            </a>
         </li>

         <!--<li class="nav-item">-->
         <!--   <a href="{{url('/admin/players')}}" class="nav-link  {{ (request()->segment(2) == 'players') ? 'active' : '' }}">-->
         <!--   <i class="nav-icon 	fas fa-users"></i>-->
         <!--     <p>-->
         <!--       Players-->
               
         <!--     </p>-->
         <!--   </a>-->
         <!--</li>-->

          <li class="nav-item">
            <a href="#" class="nav-link {{ ((request()->segment(2) == 'pages') || (request()->segment(2) == 'amenities') || (request()->segment(2) == 'regions') || (request()->segment(2) == 'cities') || (request()->segment(2) == 'page') || (request()->segment(2) == 'amenity') || (request()->segment(2) == 'settings') || (request()->segment(2) == 'home-slider'))? 'active' : '' }}">
              <i class="nav-icon 	fas fa-plug"></i>
              <p>
                System Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             <li class="nav-item">
                <a href="{{url('/admin/regions')}}" class="nav-link {{ (request()->segment(2) == 'regions') ? 'active' : '' }}">
                  <i class="fas fa-building nav-icon"></i>
                  <p>Regions</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/cities')}}" class="nav-link {{ (request()->segment(2) == 'cities') ? 'active' : '' }}">
                  <i class="fas fa-calendar nav-icon"></i>
                  <p>Cities</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/amenities')}}" class="nav-link {{ ((request()->segment(2) == 'amenities') || (request()->segment(2) == 'amenity')) ? 'active' : '' }}">
                  <i class="fas fa-clone nav-icon"></i>
                  <p>Amenities</p>
                </a>
              </li>
            
              <li class="nav-item">
                <a href="{{url('/admin/pages')}}" class="nav-link  {{ ((request()->segment(2) == 'pages') || (request()->segment(2) == 'page'))? 'active' : '' }}">
                <i class="nav-icon fas fa-edit"></i>
                  <p>
                    Pages
                  </p>
                </a>
             </li> 

             <li class="nav-item">
                <a href="{{url('/admin/settings')}}" class="nav-link  {{ ( request()->segment(2) == 'settings')? 'active' : '' }}">
                <i class="nav-icon fas fa-cogs"></i>
                  <p>
                    Settings
                  </p>
                </a>
             </li> 

             <li class="nav-item">
                <a href="{{url('/admin/home-slider')}}" class="nav-link  {{ ( request()->segment(2) == 'home-slider')? 'active' : '' }}">
                <i class="nav-icon fas fa-image"></i>
                  <p>
                    Homepage Slider
                  </p>
                </a>
             </li> 


           

            </ul>
          </li>

          @endif

          @if ( auth()->user()->role != '4' )
          <li class="nav-item">
            <a href="{{url('/admin/reports')}}" class="nav-link  {{ request()->segment(2) == 'reports' ? 'active' : '' }}">
            <i class="nav-icon 	fas fa-file"></i>
              <p>
                Reports
               
              </p>
            </a>
           
          </li>  
          @endif

          @if ( auth()->user()->role == '1' || auth()->user()->role == '2')
          <li class="nav-item">
            <a href="{{ route('coaches') }}" class="nav-link  {{ (request()->segment(2) == 'coaches' || request()->segment(2) == 'coach' || request()->segment(2) == 'off-da') ? 'active' : '' }}">
            <i class="nav-icon 	fas fa-user"></i>
              <p>
                Coaches
              </p>
            </a>
           
          </li>  
          @endif

          @if ( auth()->user()->role == '4')
          <li class="nav-item">
            <a href="{{ route('holidays') }}" class="nav-link  {{ request()->segment(2) == 'off-days' ? 'active' : '' }}">
            <i class="nav-icon 	fas fa-file"></i>
              <p>
                Off Days
              </p>
            </a>
           
          </li>  
          @endif

         
         @if ( auth()->user()->role == '1' || auth()->user()->role == '2')
          
         <li class="nav-item">
            <a href="{{url('/admin/refunds')}}" class="nav-link  {{ request()->segment(2) == 'refunds' ? 'active' : '' }}">
            <i class="nav-icon 	fas fa-money-bill-alt"></i>
              <p>
                Refunds </p>
            </a>
          </li> 
          
          <!-- <li class="nav-item">
            <a href="{{url('/admin/wallets')}}" class="nav-link  {{ request()->segment(2) == 'wallets' ? 'active' : '' }}">
            <i class="nav-icon 	fas fa-money-bill-alt"></i>
              <p>
                Wallets</p>
            </a>
          </li>   -->

          <li class="nav-item">
            <a href="{{url('/admin/bats')}}" class="nav-link  {{ request()->segment(2) == 'bats' ? 'active' : '' }}">
            <i class="nav-icon 	fas fa-table-tennis"></i>
              <p>
                Bats </p>
            </a>
          </li>  

          <li class="nav-item">
            <a href="{{url('/admin/coupons')}}" class="nav-link  {{ request()->segment(2) == 'coupons' ? 'active' : '' }}">
            <i class="nav-icon 	fas fa-gift"></i>
              <p>
                Coupons </p>
            </a>
          </li>  



          <li class="nav-item">
            <a href="{{url('/admin/contact')}}" class="nav-link  {{(request()->segment(2) == 'contact' || (request()->segment(3) == 'contact' && request()->segment(2) == 'view')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-id-card-alt"></i>
              <p>
                Contact us
              </p>
            </a>
          </li>  

          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>