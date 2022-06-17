<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{asset('assets/backend/img/AdminLTELogo.png')}}" alt="Sports Arena" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sports Arena</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/backend/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Sp</a>
        </div>
      </div> -->

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div><div class="sidebar-search-results"><div class="list-group"><a href="#" class="list-group-item"><div class="search-title"><strong class="text-light"></strong>N<strong class="text-light"></strong>o<strong class="text-light"></strong> <strong class="text-light"></strong>e<strong class="text-light"></strong>l<strong class="text-light"></strong>e<strong class="text-light"></strong>m<strong class="text-light"></strong>e<strong class="text-light"></strong>n<strong class="text-light"></strong>t<strong class="text-light"></strong> <strong class="text-light"></strong>f<strong class="text-light"></strong>o<strong class="text-light"></strong>u<strong class="text-light"></strong>n<strong class="text-light"></strong>d<strong class="text-light"></strong>!<strong class="text-light"></strong></div><div class="search-path"></div></a></div></div>
      </div>

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

          <li class="nav-item">
            <a href="#" class="nav-link {{ ((request()->segment(3) == 'customers') || (request()->segment(3) == 'court-owners'))? 'active' : '' }}">
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
  
          <li class="nav-item">
            <a href="{{url('/admin/bookings')}}" class="nav-link  {{ request()->segment(2) == 'bookings' ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-edit"></i>
              <p>
                Bookings
              </p>
            </a>
          </li>   
          
          <li class="nav-item">
            <a href="{{url('/admin/courts')}}" class="nav-link  {{ request()->segment(2) == 'courts' ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Courts
              </p>
            </a>
          </li>    

          <li class="nav-item">
            <a href="{{url('/admin/contact')}}" class="nav-link  {{ request()->segment(2) == 'contact' ? 'active' : '' }}">
            <i class="nav-icon fas fa-id-card-alt"></i>
              <p>
                Contact us
              </p>
            </a>
          </li>  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>