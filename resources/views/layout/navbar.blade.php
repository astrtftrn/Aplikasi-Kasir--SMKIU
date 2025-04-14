<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Add your custom styles here -->
    <style>
        /* Background color for navbar */
        .app-header {
            background-color: #0c4f93; /* Dark background */
        }

        /* Navbar items and icon color */
        .nav-link {
            color: #fff !important;
        }

        /* Hover effect for nav items */
        .nav-link:hover {
            color: #007bff !important;
        }

        /* Notifikasi badge */
        .badge-notification {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #dc3545;
            border-radius: 50%;
            padding: 0.3em 0.5em;
            font-size: 12px;
            color: white;
        }

        /* Profile image effect */
        .nav-item img {
            transition: transform 0.3s ease-in-out;
        }

        .nav-item img:hover {
            transform: scale(1.1); /* Slight zoom effect */
        }

        /* Dropdown styling */
        .dropdown-menu {
            border-radius: 8px;
            padding: 10px 20px;
        }

        .dropdown-item {
            padding: 10px;
            color: #333;
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
            color: #007bff;
        }

        /* Optional: Shadow for navbar */
        .app-header {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<!-- Header Start -->
<header class="app-header">
  <nav class="navbar navbar-expand-lg navbar-light">
      <ul class="navbar-nav">
          <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                  <i class="ti ti-menu-2"></i>
              </a>
          </li>
      </ul>

      <!-- Bagian kanan navbar (untuk pencarian, notifikasi, dan profil) -->
      <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
          <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

              <!-- Notifikasi -->
              <li class="nav-item">
                  <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="notificationDropdown" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="ti ti-bell"></i>
                    <!-- Notifikasi badge -->
                  </a>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                      <a class="dropdown-item" href="#">Notifikasi</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Lihat Semua</a>
                  </div>
              </li>

              <!-- Profil User -->
              <li class="nav-item dropdown">
                  <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                  </a>
                  <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                    <div class="message-body">  
                        <a href="{{ route('logout') }} "
                           onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();" 
                           class="btn btn-outline-primary mx-3 mt-2 d-block">
                           {{ __('Logout') }} 
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                        </form>
                    </div>
                  </div>
              </li>
          </ul>
      </div>
  </nav>
</header>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</body>
</html>
