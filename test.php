<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php'; ?>
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
   
    .no-margin-container, .no-margin-row, .no-margin-col {
      padding: 0;
      margin: 0;
    }
    
    
    .no-margin-row .col-2 {
      padding: 0;
    }

    
    .no-margin-row img {
      width: 100%;
      height: auto;
      display: block; 
    }
  </style>
</head>
<body class="black">

<nav class="navbar navbar-expand-lg mx-auto my-4 nav-width border-radius sticky-top dark-grey">
    <div class="container-fluid">
       
        <a class="navbar-brand" href="#">
            <img src="../../img/favicon.png" alt="Logo" width="30" class="d-inline-block align-text-top">
        </a>

        
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <span class="navbar-toggler-icon"></span>
        </button>

        
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                
                <ul class="navbar-nav">
                    <li class="nav-item mx-2">
                        <a class="nav-link white" href="../../index.php">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link white" href="../../programs.php">Programs</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link white" href="../../events.php">Events</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link white" href="../../aboutus.php">About Us</a>
                    </li>
                </ul>
                
                <div class="navbar-nav login-nav border-radius mt-4">
                    <a class="nav-link login-link bg-red border-radius" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-right-dots-fill" viewBox="0 0 16 16">
                            <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353zM5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 2 0m3 1a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>



</body>
</html>

