 <!DOCTYPE html>
<html lang="en">
<head>
    <!-- Title Meta -->
    <meta charset="utf-8" />
    <title>Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully responsive premium admin dashboard template" />
    <meta name="author" content="Techzaa" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <!-- Vendor css (Require in all Page) -->
    <link href="{{ asset('css/vendor.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Icons css (Require in all Page) -->
    <link href="{{ asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/all.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- App css (Require in all Page) -->
    <link href="{{ asset('css/app.min.css')}}" rel="stylesheet" type="text/css" />


  <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css')}}">

    <!-- DataTables CSS -->
    <link href="{{ asset('css/dataTables.bootstrap5.min.css')}}" rel="stylesheet">



    <!-- Theme Config js (Require in all Page) -->
    <script src="{{ asset('js/config.js')}}"></script>
</head>

<body>


    <!-- START Wrapper -->
    <div class="wrapper">

        <!-- ========== Topbar Start ========== -->
        <header class="topbar">
             <div class="container-fluid">
                  <div class="navbar-header">
                       <div class="d-flex align-items-center">
                            <!-- Menu Toggle Button -->
                            <div class="topbar-item">
                                 <button type="button" class="button-toggle-menu me-2">
                                      <iconify-icon icon="solar:hamburger-menu-broken" class="fs-24 align-middle"></iconify-icon>
                                 </button>
                            </div>

                            <!-- Menu Toggle Button -->
                            <div class="topbar-item">
                                 <h4 class="fw-bold topbar-button pe-none text-uppercase mb-0">Welcome Opulence Digitech</h4>
                            </div>
                       </div>

                       <div class="d-flex align-items-center gap-1">
                            <div class="dropdown topbar-item">
                                 <a type="button" class="topbar-button" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <span class="d-flex align-items-center">
                                       <img class="rounded-circle" width="32" src="{{ Auth::user()?->file ? asset('images/users/' . Auth::user()->file) : asset('images/users/avatar-1.jpg') }}" alt="User Avatar">
                                    </span>
                        

                                 </a>
                                 <div class="dropdown-menu dropdown-menu-end">
                                      <h6 class="dropdown-header">Welcome Opulence Digitech(<span class="greeting">{{ Auth::user()->name ?? 'User' }}</span>)</h6>
                                      
                                      <div class="dropdown-divider my-1"></div>

                                      <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                                           <i class="bx bx-log-out fs-18 align-middle me-1"></i><span class="align-middle">Logout</span>
                                      </a>
                                 </div>
                            </div>

                       </div>
                  </div>
             </div>
        </header>
        <!-- ========== Topbar End ========== -->

        <!-- ========== App Menu Start ========== -->
        <div class="main-nav">
             <!-- Sidebar Logo -->
             <div class="logo-box">
                  <a href="{{ route('dashbord')}}" class="logo-dark">
                       <img src="{{ asset('images/logo-sm.png')}}" class="logo-sm" alt="logo sm">
                      <img src="{{ asset('images/logo-dark.png')}}" class="logo-lg" alt="logo dark">

                  </a>

                  <a href="{{ route('dashbord')}}" class="logo-light">
                       <img src="{{ asset('images/logo-sm.png')}}" class="logo-sm" alt="logo sm">
                       <img src="{{ asset('images/logo-light.png')}}" class="logo-lg" alt="logo light">
                  </a>
             </div>

             <!-- Menu Toggle Button (sm-hover) -->
             <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
                  <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
             </button>

             <div class="scrollbar" data-simplebar>
                  <ul class="navbar-nav" id="navbar-nav">

                       <li class="menu-title">General</li>

                       <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashbord')}}">
                                 <span class="nav-icon">
                                      <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                                 </span>
                                 <span class="nav-text"> Dashboard </span>
                            </a>
                       </li>
                       @php
                         $permissions = [];

                         if (!empty($authUser->form_permission)) {
                              $permissions = $authUser->form_permission;

                              if (is_string($permissions)) {
                                   $decoded = json_decode($permissions, true);
                                   $permissions = is_array($decoded) ? $decoded : explode(',', $permissions);
                              }
                         }
                       @endphp

                       @if ($authUser->userrole == 'Admin' || $authUser->userrole == 'Operations' || in_array('User', $permissions))
                            
                       <li class="nav-item">
                         <a class="nav-link menu-arrow" href="#sidebarAdmin" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAdmin">
                              <span class="nav-icon">
                                   <iconify-icon icon="mdi:account-cog-outline"></iconify-icon>
                              </span>
                              <span class="nav-text"> Administrator </span>
                         </a>
                         <div class="collapse" id="sidebarAdmin">
                              <ul class="nav sub-navbar-nav">
                                   <li class="sub-nav-item">
                                        <a class="sub-nav-link" href="{{ route('users_list')}}">User</a>
                                   </li>
                              </ul>
                         </div>
                       </li>
                       @endif

                        <li class="nav-item">
                            <a class="nav-link menu-arrow" href="#sidebarDispatch" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDispatch">
                                 <span class="nav-icon">
                                     <iconify-icon icon="mdi:truck-delivery-outline"></iconify-icon>
                                 </span>
                                 <span class="nav-text"> Dispatch </span>
                            </a>
                            <div class="collapse" id="sidebarDispatch">
                              <ul class="nav sub-navbar-nav">
                                   @if ($authUser->userrole == 'Admin' || $authUser->userrole == 'Operations')
                                        <li class="sub-nav-item">
                                             <a class="sub-nav-link" href="{{ route('customer-list') }}">Customer</a>
                                        </li>
                                        <li class="sub-nav-item">
                                             <a class="sub-nav-link" href="{{ route('shipper-list') }}">Shipper</a>
                                        </li>
                                        <li class="sub-nav-item">
                                             <a class="sub-nav-link" href="{{ route('consignee-list') }}">Consignee</a>
                                        </li>
                                        <li class="sub-nav-item">
                                             <a class="sub-nav-link" href="{{ route('external_carrier') }}">External Carrier</a>
                                        </li>
                                        <li class="sub-nav-item">
                                             <a class="sub-nav-link" href="{{ route('load-creation') }}">Load Creation</a>
                                        </li>
                                        <li class="sub-nav-item">
                                             <a class="sub-nav-link" href="{{ route('mc-check-list') }}">MC Check</a>
                                        </li>

                                   @else
                                        @if (in_array('Customer', $permissions))
                                             <li class="sub-nav-item">
                                                  <a class="sub-nav-link" href="{{ route('customer-list') }}">Customer</a>
                                             </li>
                                        @endif

                                        @if (in_array('Shipper', $permissions))
                                             <li class="sub-nav-item">
                                                  <a class="sub-nav-link" href="{{ route('shipper-list') }}">Shipper</a>
                                             </li>
                                        @endif

                                        @if (in_array('Consignees', $permissions))
                                             <li class="sub-nav-item">
                                                  <a class="sub-nav-link" href="{{ route('consignee-list') }}">Consignee</a>
                                             </li>
                                        @endif

                                        @if (in_array('External Career', $permissions))
                                             <li class="sub-nav-item">
                                                  <a class="sub-nav-link" href="{{ route('external_carrier') }}">External Carrier</a>
                                             </li>
                                        @endif

                                        @if (in_array('Load', $permissions))
                                             <li class="sub-nav-item">
                                                  <a class="sub-nav-link" href="{{ route('load-creation') }}">Load Creation</a>
                                             </li>
                                        @endif

                                        @if (in_array('MC Check', $permissions))
                                             <li class="sub-nav-item">
                                                  <a class="sub-nav-link" href="{{ route('mc-check-list') }}">MC Check</a>
                                             </li>
                                        @endif
                                   @endif

                              </ul>
                              </div>
                       </li>
                  </ul>
             </div>
        </div>
        <!-- ========== App Menu End ========== -->
