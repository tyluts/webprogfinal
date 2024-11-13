<?php
  require_once('../config.php');
  
  $eventsSql = "SELECT * FROM events ORDER BY date asc";
  $eventsSqlResult = $con->query($eventsSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/head.php'; ?>
    <link rel="stylesheet" href="../css/admincss/dashboard.css">
    <title>Home</title>
    <style>
      .card-link:hover .card-body {
  color: #e5383b !important; /* Optional: change text color on hover */
}
    </style>
</head>
<body class="black">
    <?php include 'adminnav.php'; ?>

    <div class="content  " style="padding: 20px; margin-top: 50px; height: calc(100vh - 56px); overflow-y: auto;">
    
  
 

  <div class="container mt-5 py-5 ">
  <div class="row">
    <div class="col-md-6 mb-4" >
      <a href="page1.html" class="card-link">
        <div class="card square-card ">
          <div class="card-body d-flex flex-column justify-content-center">
            <h5 class="card-title text-center">Title 1</h5>
            <p class="card-text text-center">This is the description for the first card.</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-6 mb-4">
      <a href="page2.html" class="card-link">
        <div class="card square-card ">
          <div class="card-body d-flex flex-column justify-content-center">
            <h5 class="card-title text-center">Title 2</h5>
            <p class="card-text text-center">This is the description for the second card.</p>
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-4">
      <a href="page3.html" class="card-link">
        <div class="card square-card">
          <div class="card-body d-flex flex-column justify-content-center">
            <h5 class="card-title text-center">Title 3</h5>
            <p class="card-text text-center">This is the description for the third card.</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-6 mb-4">
      <a href="page4.html" class="card-link">
        <div class="card square-card">
          <div class="card-body d-flex flex-column justify-content-center">
            <h5 class="card-title text-center">Title 4</h5>
            <p class="card-text text-center">This is the description for the fourth card.</p>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
</div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>