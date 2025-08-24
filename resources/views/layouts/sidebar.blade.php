<style>
  /* .sidebar-body {
    display: block;
    overflow-y: auto;
    padding: 1em;
    margin: 0;
  }
  .sidebar-body::-webkit-scrollbar {
    width: 5px;
    height: 8px;
    background-color: #F3F5F9; 
  }
  .sidebar-body::-webkit-scrollbar-thumb {
    background: #A8A8A8;
  } */
  </style>
  <div class="sidebar">
      <div class="sidebar-header d-flex justify-content-center">
        <img src="{{ asset('front-end/images/logo/cpr.png') }}" alt="" width="100" height="80">
      </div>
      <div id="sidebarMenu" class="sidebar-body">
        <div class="nav-group show">
          <a href="#" class="nav-label">Dashboard</a>
              <ul class="nav nav-sidebar">
                <li class="nav-item">
                      <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="ri-suitcase-2-fill"></i> <span>Dashboard</span></a>
                </li>
                <li class="nav-item">
                      <a href="{{ route('sales.list') }}" class="nav-link {{ request()->routeIs('sales.list') ? 'active' : '' }}"><i class="ri-mail-unread-fill"></i> <span>Orders </span></a>
                </li>
                <li class="nav-item">
              <a href="{{ route('property.view') }}" class="nav-link {{ request()->routeIs('property.view') ? 'active' : '' }}"><i class="ri-home-4-fill"></i> <span>Categories</span></a>
                </li>
                {{-- <li class="nav-item">
                  <a href="{{ route('admin.advertisement') }}" class="nav-link {{ request()->routeIs('admin.advertisement') ? 'active' : '' }}"><i class="ri-advertisement-fill"></i><span>Advertisement</span></a>
                </li>
                <li class="nav-item">
              <a href="{{ route('service.index') }}" class="nav-link {{ request()->routeIs('service.index') ? 'active' : '' }}">
                <i class="ri-customer-service-2-fill"></i> <span>Services List</span>
            </a>
              </li>
              <li class="nav-item">
              <a href="{{ route('owners.index') }}" class="nav-link {{ request()->routeIs('owners.index') ? 'active' : '' }}">
                <i class="ri-group-fill"></i> <span>Sellers List</span>
            </a>
              </li>
               <li class="nav-item">
              <a href="{{ route('packages.index') }}" class="nav-link {{ request()->routeIs('packages.index') ? 'active' : '' }}">
                <i class="ri-price-tag-3-fill"></i> <span>Package List</span>
            </a>
              </li> --}}
              </ul>
            </div>
        <div class="nav-group show">
               <a href="#" class="nav-label">Home</a>
              <ul class="nav nav-sidebar">
                 <li class="nav-item">
              <a href="{{ route('general.details') }}" class="nav-link {{ request()->routeIs('general.details') ? 'active' : '' }}">
                <i class="ri-at-line"></i><span>General Details</span>
            </a>
              </li>
               <li class="nav-item">
              <a href="{{ route('slider.list') }}" class="nav-link {{ request()->routeIs('slider.list') ? 'active' : '' }}">
                <i class="ri-image-fill"></i> <span> Home Slider</span>
            </a>
              </li>
               <li class="nav-item">
              <a href="{{ route('register.to.post') }}" class="nav-link {{ request()->routeIs('register.to.post') ? 'active' : '' }}">
                <i class="ri-file-shield-2-line"></i> <span> Home Banner </span>
            </a>
              </li>
               </ul>
            </div>
        <div class="nav-group show">
               <a href="#" class="nav-label">Others</a>
              <ul class="nav nav-sidebar">
               <li class="nav-item">
                <a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">
                    <i class="ri-newspaper-fill"></i> <span> Blog </span>
                </a>
            </li>
               <li class="nav-item">
              <a href="{{ route('terms.conditions') }}" class="nav-link {{ request()->routeIs('terms.conditions') ? 'active' : '' }}">
                <i class="ri-file-list-3-fill"></i> <span>Terms and Conditions </span>
            </a>
              </li>
               <li class="nav-item">
              <a href="{{ route('privacy.policy') }}" class="nav-link {{ request()->routeIs('privacy.policy') ? 'active' : '' }}">
                <i class="ri-git-repository-private-line"></i> <span>Privacy Policy</span>
            </a>
              </li>
               <li class="nav-item">
              <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                <i class="ri-user-settings-line"></i> <span>Profile</span>
            </a>
              </li>
               <li class="nav-item">
              <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                <i class="ri-logout-box-r-line"></i> <span>Logout</span>
            </a>
              </li>
              </ul>
        </div>
        {{-- <div class="nav-group show">
          <a href="#" class="nav-label">Sell</a>
          <ul class="nav nav-sidebar">
            <li class="nav-item">
              <a href="product.html" class="nav-link active"><i class="ri-suitcase-2-fill"></i> <span>Product Management</span></a>
            </li>
          </ul>
        </div> --}}
  
      </div><!-- sidebar-body -->
    </div>