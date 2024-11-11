<?php
  session_start();
  require_once('../config.php');
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom fixed-top">
  <div class="container-fluid">
    <button class="btn btn-outline-secondary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
      <span>Admin Panel</span>
    </a>
   
  </div>
</nav>

<!-- Sidebar for larger screens -->
<div class="d-none d-lg-flex flex-column bg-light border-end position-fixed" style="width: 250px; top: 56px; bottom: 0; left: 0; overflow-y: auto;">
  <ul class="nav flex-column p-4">
    <li class="nav-item">
      <a class="nav-link text-dark" href="dashboard.php">
         Dashboard
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark" href="programs.php">
         Manage Programs
       
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark" href="events.php">
         Manage Events
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark" href="hero.php">
         Manage Hero 
      </a>
    </li>
     <li class="nav-item">
      <a class="nav-link text-dark" href="news.php">
         Manage News
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark" href="aboutus.php">
         Manage About Us
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark" href="logout.php">
         Logout
      </a>
    </li>
  </ul>
</div>

<!-- Sidebar for smaller screens (offcanvas) -->
<div class="offcanvas offcanvas-start bg-light" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav flex-column">
      <li class="nav-item">
      <a class="nav-link text-dark" href="dashboard.php">
         Manage Dashboard
      </a>
    </li>
       <li class="nav-item">
      <a class="nav-link text-dark" href="programs.php">
         Manage Programs
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark" href="events.php">
         Manage Events
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark" href="hero.php">
         Manage Hero 
      </a>
    </li>
     <li class="nav-item">
      <a class="nav-link text-dark" href="news.php">
         Manage News
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark" href="aboutus.php">
         Manage About Us
      </a>
    </li>
     <li class="nav-item">
      <a class="nav-link text-dark" href="#">
        Logout
      </a>
    </li>
      
    </ul>
  </div>
</div>

<!-- Main Content Area -->


<!-- Bootstrap JavaScript Bundle (required for dropdown and offcanvas) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
  /* Adjust main content padding for larger screens */
  @media (min-width: 992px) {
    .content {
      margin-left: 250px; /* Align content to the right of the sidebar */
    }
  }

  /* Adjust main content for smaller screens */
  @media (max-width: 991.98px) {
    .content {
      margin-left: 0; /* Remove margin for mobile screens */
      padding-left: 10px;
      padding-right: 10px; /* Add padding for better appearance */
    }
  }

  body {
    margin: 0;
    padding: 0;
  }
</style>          