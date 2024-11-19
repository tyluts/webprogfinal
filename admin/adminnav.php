
<?php
  
  require_once('../config.php');
?>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom fixed-top">
  <div class="container-fluid">
    <button class="btn btn-outline-secondary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
      <span>Admin Panel</span>
    </a>
   
  </div>
</nav>

<!-- Desktop Sidebar -->
<div class="d-none d-lg-flex flex-column bg-dark border-end position-fixed" style="width: 250px; top: 56px; bottom: 0; left: 0; overflow-y: auto;">
    <ul class="nav flex-column p-4">
        <li class="nav-item">
            <a class="nav-link text-white" href="dashboard.php">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="manage_programs.php" id="programsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-collection me-2"></i>Manage Programs
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="manage_curriculum.php"><i class="bi bi-journal-text me-2"></i>Manage Curriculum</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="manage_programs.php"><i class="bi bi-collection me-2"></i>Manage Programs</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="manage_social.php"><i class="bi bi-share me-2"></i>Manage Social</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="events.php">
                <i class="bi bi-calendar-event me-2"></i>Manage Events
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="hero.php">
                <i class="bi bi-image me-2"></i>Manage Hero
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="news.php">
                <i class="bi bi-newspaper me-2"></i>Manage News
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="aboutus.php">
                <i class="bi bi-info-circle me-2"></i>Manage About Us
            </a>
        </li>
        <li class="nav-item mt-auto">
            <a class="nav-link text-white" href="logout.php">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
            </a>
        </li>
    </ul>
</div>

<div class="offcanvas offcanvas-start bg-dark" tabindex="-1" id="sidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-white">Menu</h5>
        <button type="button" class="btn-close bg-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white" href="dashboard.php">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-collection me-2"></i>Manage Programs
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="manage_curriculum.php"><i class="bi bi-journal-text me-2"></i>Manage Curriculum</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="manage_programs.php"><i class="bi bi-collection me-2"></i>Manage Programs</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="manage_social.php"><i class="bi bi-share me-2"></i>Manage Social</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="events.php">
                    <i class="bi bi-calendar-event me-2"></i>Manage Events
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="hero.php">
                    <i class="bi bi-image me-2"></i>Manage Hero
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="news.php">
                    <i class="bi bi-newspaper me-2"></i>Manage News
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="aboutus.php">
                    <i class="bi bi-info-circle me-2"></i>Manage About Us
                </a>
            </li>
            <li class="nav-item mt-auto">
                <a class="nav-link text-white" href="logout.php">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                </a>
            </li>
        </ul>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
        body {
            margin: 0;
            padding-top: 56px;
        }

        .sidebar {
            z-index: 1000;
        }

        .dropdown-menu {
            z-index: 1030;
        }

        @media (min-width: 992px) {
            .content {
                margin-left: 250px;
            }
        }

        @media (max-width: 991.98px) {
            .content {
                margin-left: 0;
                padding: 0 10px;
            }
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .dropdown-menu-dark .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>