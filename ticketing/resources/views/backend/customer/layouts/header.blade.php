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

              <li class="nav-item px-2">
                  <a class="nav-link" href="{{ route('explore_events') }}">
                      Buy
                  </a>
              </li>

              <li class="nav-item px-4">
                  <a class="nav-link" href="{{ route('sell_tickets') }}">
                      Sell
                  </a>
              </li>

              <li class="nav-item dropdown pe-3">

                  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                      data-bs-toggle="dropdown">
                      {{-- <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle"> --}}
                      <span
                          class="d-none d-md-block dropdown-toggle ps-2 text-capitalize">{{ auth()->user()->name }}</span>
                  </a><!-- End Profile Iamge Icon -->

                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                      <li class="dropdown-header">
                          <h6 class="text-capitalize">{{ auth()->user()->name }}</h6>
                          <span>{{ auth()->user()->email }}</span>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>


                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="{{ route('settings') }}">
                              <i class="bi bi-gear"></i>
                              <span>Account Settings</span>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      {{-- <li>
                          <a class="dropdown-item d-flex align-items-center" href="#!">
                              <i class="bi bi-question-circle"></i>
                              <span>Need Help?</span>
                          </a>
                      </li> --}}
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
              <a class="nav-link " href="{{ route('customer_dashboard') }}">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li><!-- End Dashboard Nav -->

          <li class="nav-item">
              <a class="nav-link " href="{{ route('my_bids') }}">
                  <i class="bi bi-cart-check"></i>
                  <span>My Bids</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link " href="{{ route('orders') }}">
                  <i class="bi bi-cart-check"></i>
                  <span>My Orders</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link " href="{{ route('listings') }}">
                  <i class="bi bi-card-list"></i>
                  <span>My Listings</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link " href="{{ route('sales') }}">
                  <i class="bi bi-bar-chart"></i>
                  <span>My Sales</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link " href="{{ route('payments') }}">
                  <i class="bi bi-currency-rupee"></i>
                  <span>Payments</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link " href="{{ route('settings') }}">
                  <i class="bi bi-gear"></i>
                  <span>Settings</span>
              </a>
          </li>

          {{-- <li class="nav-item">
              <a class="nav-link " href="{{ route('support') }}">
                  <i class="bi bi-headset"></i>
                  <span>Customer Support</span>
              </a>
          </li> --}}

      </ul>

  </aside><!-- End Sidebar-->
