<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700&display=swap"
    rel="stylesheet">

  <title>{{ $title }}</title>

  <link href="{{ asset('admin-asset/css/app.css') }}" rel="stylesheet" />
</head>

<body>
  <div class="wrapper">
    <nav id="sidebar" class="sidebar d-print-none">
      <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="#">
          Sok <span class="text-white">Kabeh</span>
        </a>

        <ul class="sidebar-nav">

          @if (auth()->user()->is_admin)
          <li class="sidebar-header">
            Administrator
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('admin.product.index') }}">
              <i class="align-middle" data-feather="database"></i>
              <span class="align-middle">Products</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('admin.category.index') }}">
              <i class="align-middle" data-feather="layers"></i>
              <span class="align-middle">Categories</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('admin.transaction.index') }}">
              <i class="align-middle" data-feather="dollar-sign"></i>
              <span class="align-middle">Transactions</span>
            </a>
          </li>
          @endif

          <li class="sidebar-header">
            User
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('admin.profile.index') }}">
              <i class="align-middle" data-feather="user"></i>
              <span class="align-middle">Profile</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('admin.profile.transaction') }}">
              <i class="align-middle" data-feather="maximize-2"></i>
              <span class="align-middle">User Transaction</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('admin.profile.edit') }}">
              <i class="align-middle" data-feather="settings"></i>
              <span class="align-middle">Settings</span>
            </a>
          </li>

        </ul>
      </div>
    </nav>

    <div class="main">
      <nav class="navbar navbar-expand navbar-light navbar-bg d-print-none">
        <a class="sidebar-toggle d-flex">
          <i class="hamburger align-self-center"></i>
        </a>

        <div class="navbar-collapse collapse">
          <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
              <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

              <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                {{-- <img src="{{ asset('home-asset/images/person_1.jpg') }}" style="object-fit: cover;"
                  class="avatar img-fluid rounded mr-1" alt="Charles Hall" /> --}}
                <span class="text-dark">Welcome Back,
                  {{ auth()->user()->firstname }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('admin.profile.index') }}">
                  <i class="align-middle mr-1" data-feather="user"></i> Profile
                </a>
                <a class="dropdown-item" href="{{ route('cart.index') }}">
                  <i class="align-middle mr-1" data-feather="shopping-cart"></i> Shopping Cart
                </a>
                <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                  <i class="align-middle mr-1" data-feather="settings"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('home') }}">Kembali
                  ke Website</a>
                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#logoutModal">
                  Log out
                </button>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Modal -->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">LOGOUT</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body m-3">
              <p class="mb-0 text-center h2">
                Are you sure ?
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cancel
              </button>
              <form action="{{ route('admin.logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger">
                  Logout
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <main class="content">
        @yield('content')
      </main>

      <footer class="footer d-print-none">
        <div class="container-fluid">
          <div class="row text-muted">
            <div class="col-6 text-left">
              <p class="mb-0"><strong>Sok Kabeh</strong>
                &copy;
              </p>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <script src="{{ asset('admin-asset/js/app.js') }}"></script>

  @yield('script')

</body>

</html>