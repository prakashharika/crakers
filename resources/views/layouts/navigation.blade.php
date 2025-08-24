<style>
.profile-image img {
    font-size: 22px;
    animation: rotation 5s infinite linear;
    color: #506fd9;
}
.header-main .form-search {
    background-color: #fff;
}
</style>
<div class="header-main px-3 px-lg-4">
    <a id="menuSidebar" href="#" class="menu-link me-3 me-lg-4"><i class="ri-menu-2-fill"></i></a>

    <div class="form-search me-auto">
    </div><!-- form-search -->
    {{-- <div class="dropdown dropdown-skin">
      <a href="#" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside"><i class="ri-settings-3-line"></i></a>
      <div class="dropdown-menu dropdown-menu-end mt-10-f">
        <label>Skin Mode</label>
        <nav id="skinMode" class="nav nav-skin">
          <a href="#" class="nav-link active">Light</a>
          <a href="#" class="nav-link">Dark</a>
        </nav>
        <hr>
        <label>Sidebar Skin</label>
        <nav id="sidebarSkin" class="nav nav-skin">
          <a href="#" class="nav-link active">Default</a>
          <a href="#" class="nav-link">Prime</a>
          <a href="#" class="nav-link">Dark</a>
        </nav>
      </div><!-- dropdown-menu -->
    </div> --}}
    <div class="dropdown dropdown-notification ms-3 ms-xl-4">
      <a href="#" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside"><small>3</small><i class="ri-notification-3-line"></i></a>
      <div class="dropdown-menu dropdown-menu-end mt-10-f me--10-f">
        <div class="dropdown-menu-header">
          <h6 class="dropdown-menu-title">Notifications</h6>
        </div><!-- dropdown-menu-header -->
        <ul class="list-group">
          <li class="list-group-item">
            <div class="avatar online"><img src="../assets/img/img10.jpg" alt=""></div>
            <div class="list-group-body">
              <p><strong>Dominador Manuel</strong> and <strong>100 other people</strong> reacted to your comment "Tell your partner that...</p>
              <span>Aug 20 08:55am</span>
            </div><!-- list-group-body -->
          </li>
          <li class="list-group-item">
            <div class="avatar online"><img src="../assets/img/img11.jpg" alt=""></div>
            <div class="list-group-body">
              <p><strong>Angela Ighot</strong> tagged you and <strong>9 others</strong> in a post.</p>
              <span>Aug 18 10:30am</span>
            </div><!-- list-group-body -->
          </li>
          <li class="list-group-item">
            <div class="avatar"><span class="avatar-initial bg-primary">a</span></div>
            <div class="list-group-body">
              <p>New listings were added that match your search alert <strong>house for rent</strong></p>
              <span>Aug 15 08:10pm</span>
            </div><!-- list-group-body -->
          </li>
        </ul>
      </div><!-- dropdown-menu -->
    </div><!-- dropdown -->
    <div class="dropdown dropdown-profile ms-3 ms-xl-4">
        <a href="#" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside"><div class="avatar online profile-image"><img src="{{ asset('assets/img/img34.jpg') }}" alt=""></div></a>
        <div class="dropdown-menu dropdown-menu-end mt-10-f">
          <div class="dropdown-menu-body">
            <div class="avatar avatar-xl online mb-3"><img src="{{ asset('assets/img/img34.jpg') }}" alt=""></div>
            <h5 class="mb-1 text-dark fw-semibold">Eros</h5>
            <p class="fs-sm text-secondary">Admin</p>
            <nav class="nav">
              <a href="{{ route('profile.edit') }}"><i class="ri-user-settings-line"></i> Account Settings</a>
              <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
                
              </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ri-logout-box-r-line"></i> Log Out
            </a>
                        </nav>
          </div><!-- dropdown-menu-body -->
        </div><!-- dropdown-menu -->
    </div><!-- dropdown -->
  </div>