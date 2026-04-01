  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

      <div class="d-flex align-items-center justify-content-between">
          <a href="{{ route('home') }}" class="px-3">
              {{-- <img src="assets/img/logo.png" alt="">
              <span class="d-none d-lg-block">Queues</span> --}}
              <img width="100px" src="{{ asset('/queues-logo.png') }}" alt="">
          </a>
          <i class="bi bi-list toggle-sidebar-btn"></i>
      </div><!-- End Logo -->



      <nav class="header-nav ms-auto">
          <ul class="d-flex align-items-center">

              {{-- <li class="nav-item dropdown">

                  <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                      <i class="bi bi-bell"></i>
                      <span class="badge bg-primary badge-number">4</span>
                  </a>

                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                      <li class="dropdown-header">
                          You have 4 new notifications
                          <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li class="notification-item">
                          <i class="bi bi-exclamation-circle text-warning"></i>
                          <div>
                              <h4>Lorem Ipsum</h4>
                              <p>Quae dolorem earum veritatis oditseno</p>
                              <p>30 min. ago</p>
                          </div>
                      </li>

                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li class="notification-item">
                          <i class="bi bi-x-circle text-danger"></i>
                          <div>
                              <h4>Atque rerum nesciunt</h4>
                              <p>Quae dolorem earum veritatis oditseno</p>
                              <p>1 hr. ago</p>
                          </div>
                      </li>

                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li class="notification-item">
                          <i class="bi bi-check-circle text-success"></i>
                          <div>
                              <h4>Sit rerum fuga</h4>
                              <p>Quae dolorem earum veritatis oditseno</p>
                              <p>2 hrs. ago</p>
                          </div>
                      </li>

                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li class="notification-item">
                          <i class="bi bi-info-circle text-primary"></i>
                          <div>
                              <h4>Dicta reprehenderit</h4>
                              <p>Quae dolorem earum veritatis oditseno</p>
                              <p>4 hrs. ago</p>
                          </div>
                      </li>

                      <li>
                          <hr class="dropdown-divider">
                      </li>
                      <li class="dropdown-footer">
                          <a href="#">Show all notifications</a>
                      </li>

                  </ul>
                  <!-- End Notification Dropdown Items -->
              </li> --}}
              <!-- End Notification Nav -->


              <li class="nav-item dropdown pe-3">

                  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                      data-bs-toggle="dropdown">
                      {{-- <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle"> --}}
                      <span
                          class="d-none d-md-block dropdown-toggle ps-2 text-capitalize">{{ auth()->user()->name }}</span>
                  </a>
                  <!-- End Profile Iamge Icon -->

                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                      <li class="dropdown-header">
                          <h6 class="text-capitalize">{{ auth()->user()->name }}</h6>
                          <span>{{ auth()->user()->email }}</span>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>


                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="{{ route('admin_settings') }}">
                              <i class="bi bi-gear"></i>
                              <span>Account Settings</span>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                              <i class="bi bi-question-circle"></i>
                              <span>Need Help?</span>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                              <i class="bi bi-box-arrow-right"></i>
                              <span>Sign Out</span>
                          </a>
                      </li>

                  </ul><!-- End Profile Dropdown Items -->
              </li><!-- End Profile Nav -->

          </ul>
      </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a class="nav-link " href="{{ route('admin_dashboard') }}">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li><!-- End Dashboard Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-gem"></i><span>Concerts</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('all_concerts') }}">
                          <i class="bi bi-circle"></i><span>All Concerts</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('add_new_concert') }}">
                          <i class="bi bi-circle"></i><span>Add New Concert</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('stadiums') }}">
                          <i class="bi bi-circle"></i><span>Stadiums</span>
                      </a>
                  </li>

              </ul>
          </li>
          <!-- End Components Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-journal-text"></i><span>Tickets</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('unverified_tickets') }}">
                          <i class="bi bi-circle"></i><span>Unverified Tickets</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('active_tickets') }}">
                          <i class="bi bi-circle"></i><span>Verified Tickets</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('sold_tickets') }}">
                          <i class="bi bi-circle"></i><span>Sold Tickets</span>
                      </a>
                  </li>

              </ul>
          </li><!-- End Forms Nav -->

          <li class="nav-item">
              <a class="nav-link " href="{{ route('customers') }}">
                  <i class="bi bi-people"></i>
                  <span>Customers</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link " href="{{ route('bidings') }}">
                  <i class="bi bi-bar-chart"></i>
                  <span>Bidings</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link " href="{{ route('charges') }}">
                  <i class="bi bi-currency-rupee"></i>
                  <span>Charges</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-layout-text-window-reverse"></i><span>Payments</span><i
                      class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('payment_records') }}">
                          <i class="bi bi-circle"></i><span>Records</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('payment_requests') }}">
                          <i class="bi bi-circle"></i><span>Request</span>
                      </a>
                  </li>
              </ul>
          </li><!-- End Tables Nav -->

          <li class="nav-item">
              <a class="nav-link " href="{{ route('admin_settings') }}">
                  <i class="bi bi-gear"></i>
                  <span>Settings</span>
              </a>
          </li>

      </ul>

  </aside><!-- End Sidebar-->
