<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title> @yield('title') || Ticketing System</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('assets/bundles/dropzonejs/dropzone.css') }}"> -->

  <link rel="stylesheet" href="{{ asset('assets/bundles/summernote/summernote-bs4.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/bundles/codemirror/lib/codemirror.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/bundles/codemirror/theme/duotone-dark.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/bundles/ionicons/css/ionicons.min.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/bundles/pretty-checkbox/pretty-checkbox.min.css') }}">
  <link rel='shortcut icon' type='image/x-icon' href="{{ asset('assets/img/logo.png') }} "/>
  <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}">


  <style type="text/css">
     .side-color{color: #000;}
  </style>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a>
            </li>

            <!-- <li>
              <form class="form-inline mr-auto" action="{{ route('searchTicketProcess') }}" method="POST">
                @csrf

                <div class="search-element">
                  <input class="form-control" type="search" name="search" placeholder="Ticket No." aria-label="Search" data-width="200" id="search">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </li>

            <li>
              <form class="form-inline mr-auto" action="{{ route('searchCustomerTicketProcess') }}" method="POST">
                @csrf

                <div class="search-element">
                  <input class="form-control" type="search" name="customer_id" placeholder="Customer ID." aria-label="Search" data-width="200">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </li>-->
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li>Login: {{ auth()->user()->email }}</li>
          
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="{{ auth()->user()->photo }}"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-item">Hello, {{ auth()->user()->first_name }}</div>
              <div class="dropdown-divider"></div>
              <a href="{{ route('changePassword') }}" class="dropdown-item has-icon"> <i class="fas fa-lock"></i> Change Password
              </a> 
              <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}"> <img alt="image" src="{{ asset('assets/img/logo.png') }}" class="header-logo" /> <span class="logo-name" class="side-color">HelpDesk</span>
            </a>
          </div>
          <ul class="sidebar-menu mt-5" style="color: #FFF;">
            <li class="menu-header"></li>
            <li class="dropdown">
              <a href="{{ route('dashboard') }}" class="nav-link"><i data-feather="monitor" class="side-color"></i><span class="side-color">Dashboard</span></a>
            </li>
            

            <li class="menu-header" style="color: #FFF;">Ticket Management</li>
              <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                    data-feather="message-square" class="side-color"></i><span class="side-color">Tickets</span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('myTicket.list') }}"><span style="color: #FFF;">My Tickets</span></a></li>
                  <li><a href="{{ route('ticket.create') }}"><span style="color: #FFF;">Create New Ticket</span></a></li>
                  <li><a href="{{ route('search') }}"><span style="color: #FFF;">Search</span></a></li>
                </ul>
              </li> 

              <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                    data-feather="user-check" class="side-color"></i><span class="side-color">Customers</span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('customer.list') }}"><span style="color: #FFF;">Customer List</span></a></li>
                  @if(auth()->user()->role == 1)
                    <li><a href="{{ route('customer.create') }}"><span style="color: #FFF;">Add Customer</span></a></li>
                  @endif
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                    data-feather="home" class="side-color"></i><span class="side-color">POP</span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('pop.list') }}"><span style="color: #FFF;">POP List</span></a></li>
                  @if(auth()->user()->role == 1)
                    <li><a href="{{ route('pop.create') }}"><span style="color: #FFF;">Add POP</span></a></li>
                  @endif
                </ul>
              </li>

              @if(auth()->user()->role == 1) 
                <li class="menu-header" style="color: #FFF;">Administration</li>

                
                <li class="dropdown">
                  <a href="#" class="menu-toggle nav-link has-dropdown"><i
                      data-feather="user" class="side-color"></i><span class="side-color">Users</span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('user.list') }}"><span style="color: #FFF;">User List</span></a></li>
                    <li><a href="{{ route('user.register') }}"><span style="color: #FFF;">Add User</span></a></li>
                  </ul>
                </li> 

                <li class="dropdown">
                  <a href="#" class="menu-toggle nav-link has-dropdown"><i
                      data-feather="users" class="side-color"></i><span class="side-color">Groups</span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('group.list') }}"><span style="color: #FFF;">Group List</span></a></li>
                    <li><a href="{{ route('group.create') }}"><span style="color: #FFF;">Add Group</span></a></li>
                  </ul>
                </li>

                <li class="dropdown">
                  <a href="#" class="menu-toggle nav-link has-dropdown"><i
                      data-feather="mail" class="side-color"></i><span class="side-color">Email</span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('customerEmail') }}"><span style="color: #FFF;">Email To Customer</span></a></li>
                  </ul>
                </li>

                <li class="dropdown">
                  <a href="#" class="menu-toggle nav-link has-dropdown"><i
                      data-feather="settings" class="side-color"></i><span class="side-color">Settings</span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('smtpConfigure') }}"><span style="color: #FFF;">SMTP Configure</span></a></li>
                    <li><a href="{{ route('emailNotification') }}"><span style="color: #FFF;">Notifications</span></a></li>
                  </ul>
                </li>
              @endif
            
          </ul>
        </aside>
      </div>
      <!-- Main Content -->
      <div style="background-color: #EBF9F7;">
        @yield('content')
      </div>
      

    </div>
      <footer class="main-footer">
        <div class="footer-left">
          <a href="0#">COPYRIGHT © 2020-2021 Royal Green Limited. ALL RIGHTS RESERVED</a></a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="{{ asset('assets/js/app.min.js') }}"></script>

  <script src="{{ asset('assets/bundles/summernote/summernote-bs4.js') }}"></script>
  <script src="{{ asset('assets/bundles/codemirror/lib/codemirror.js') }}"></script>
  <script src="{{ asset('assets/bundles/codemirror/mode/javascript/javascript.js') }}"></script>
  <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
  <script src="{{ asset('assets/bundles/ckeditor/ckeditor.js') }}"></script>

  <!-- Page Specific JS File -->
  <!-- <script src="{{ asset('assets/js/page/ckeditor.js') }}"></script> -->
  

  <!-- JS Libraies -->
  <script src="{{ asset('assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/page/index.js') }}"></script>
  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script src="{{ asset('assets/js/page/ion-icons.js') }}"></script>



  @stack('scripts')

</body>

</html>