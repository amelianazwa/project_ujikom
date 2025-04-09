<nav
  class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
  id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <!-- Place this tag where you want the button to render. -->

      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">

                <span class="avatar-initial " style="border-radius: 500px"><i class='bx bxs-user'></i></span>

        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            {{-- <li>
                <a class="dropdown-item" href="{{url('register')}}">
                  <i class="mdi mdi-power me-1 mdi-20px"></i>
                  <span class="align-middle">Register</span>
                </a>
              </li> --}}

          {{-- <li>
            <div class="dropdown-divider"></div>
          </li> --}}
          <li>
            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#logoutModal">
              <i class="mdi mdi-power me-1 mdi-20px"></i>
              <span class="align-middle">Log Out</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>
</nav>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Add modal-dialog-centered class -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <img src="/images/group.svg" alt="Konfirmasi Logout" style="width: 200px;">
          </div>
          <div class="text-center">
            <i class="fas fa-exclamation-circle fa-3x text-danger"></i>
            <h5 class="mt-3"><b>ANDA YAKIN INGIN KELUAR??</b></h5>
          </div>
        </div>

        <!-- Centered Buttons -->
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">TIDAK</button>
          <button type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">YA</button>
          <form action="{{ route('logout') }}" method="post" id="logout-form">
            @csrf
          </form>
        </div>
      </div>
    </div>
</div>



