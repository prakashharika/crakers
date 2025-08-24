@php
$user = Auth::guard('seller')->user();
$package = App\Models\OrderPackage::where('land_owner_id', $user->id)
        ->where('payment_status', 'success')
        ->where('status', 'active')
        ->first();
@endphp
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
    .sidebar-body .nav-label2 {
    display: block;
    padding: 12px 20px;
    font-size: 11px;
    font-family: "Archivo", sans-serif;
    text-transform: uppercase;
    color: #6e7985;
    letter-spacing: .7px;
    position: relative;
}
    </style>
    <div class="sidebar">
        <div class="sidebar-header d-flex justify-content-center">
          <img src="{{ asset('assets/img/logo.jpeg') }}" alt="" width="100" height="80">
        </div>
        <div id="sidebarMenu" class="sidebar-body">
          <div class="nav-group show">
            <a href="#" class="nav-label">Dashboard</a>
            <ul class="nav nav-sidebar">
              <li class="nav-item">
                <a href="{{ route('seller.dashboard') }}" class="nav-link {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}"><i class="ri-suitcase-2-fill"></i> <span>Dashboard</span></a>
              </li>
     
              <li class="nav-item">
                <a href="{{ route('my.packages') }}" class="nav-link {{ request()->routeIs('my.packages') ? 'active' : '' }}"><i class="ri-star-half-fill"></i> <span>My Packages</span></a>
              </li>
              <li class="nav-item">
                <a href="{{ route('property-cate-owner.view') }}" class="nav-link {{ request()->routeIs('property-cate-owner.view') ? 'active' : '' }}"><i class="ri-home-4-fill"></i> <span>Post Property</span></a>
              </li>
              <li class="nav-item">
                <a href="{{ route('seller.sales.list') }}" class="nav-link {{ request()->routeIs('seller.sales.list') ? 'active' : '' }}"><i class="ri-mail-unread-fill"></i> <span>Sales List</span></a>
              </li>
              <li class="nav-item">
                <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link"><i class="ri-logout-box-r-line"></i> <span>Logout</span></a>
              </li>
            </ul>
          </div><!-- nav-group -->
          <div class="nav-group">
            {{-- <a href="#" class="nav-label">Buy</a>
            <ul class="nav nav-sidebar">
              <li class="nav-item">
                <a href="{{ route('property.view') }}" class="nav-link {{ request()->routeIs('property.view') ? 'active' : '' }}"><i class="ri-home-4-fill"></i> <span>Property List</span></a>
              </li>
            </ul> --}}
          </div>
          <!-- nav-group -->
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