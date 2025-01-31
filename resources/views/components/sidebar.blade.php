@php
  $user = Session::get('user');
@endphp
   <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
          <img src="{{ url('images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Blue Label</span>
        </a>
    
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{ url('images/user.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">{{ $user->name }}</a>
            </div>
          </div>
    
          <!-- SidebarSearch Form -->
          <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div> -->
    
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

              <li class="nav-header">Nav Links</li>

              @if ($user->role === 1 || $user->role === 2)
                <li class="nav-item">
                  <a href="/" class="nav-link">
                    <i class="nav-icon far fa-chart-bar"></i>
                    <p>
                      Chart Data
                    </p>
                  </a>
                </li>
              @endif

              @if ($user->role == 1)
                <li class="nav-item">
                  <a href="./voters" class="nav-link">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      Voters
                    </p>
                  </a>
                </li>
              @endif

              @if ($user->role == 1)
                <li class="nav-item">
                  <a href="./votes" class="nav-link">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      Votes
                    </p>
                  </a>
              </li>
              @endif

              @if ($user->role == 1 || $user->role === 3)
                <li class="nav-item">
                  <a href="/import" class="nav-link">
                    <i class="nav-icon fas fa-file-import"></i>
                    <p>
                      Import
                    </p>
                  </a>
                </li>
              @endif

              @if ($user->role == 1)
                <li class="nav-item">
                  <a href="./users" class="nav-link">
                    <i class="nav-icon far fa-address-book"></i>
                    <p>
                      Users
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