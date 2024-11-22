<?php
  require_once('../config.php');
  
  $eventsSql = "SELECT COUNT(ID) as count FROM events";
  $eventsSqlResult = $con->query($eventsSql);
  $eventsCount = $eventsSqlResult->fetch_assoc()['count'];

  $postsSql = "SELECT COUNT(ID) as count FROM posts";
  $postsSqlResult = $con->query($postsSql);
  $postsCount = $postsSqlResult->fetch_assoc()['count'];
  
  $department_programsSql = "SELECT COUNT(ID) as count FROM department_programs";
  $department_programsSqlResult = $con->query($department_programsSql);
  $department_programsCount = $department_programsSqlResult->fetch_assoc()['count'];

  $program_infoSql = "SELECT COUNT(ID) as count FROM program_info";
  $program_infoSqlResult = $con->query($program_infoSql);
  $program_infoCount = $program_infoSqlResult->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/head.php'; ?>
    <link rel="stylesheet" href="../css/admincss/dashboard.css">
    <title>Home</title>
    <style>
      .card-link:hover .card-body {
  color: #e5383b !important; 
}
    </style>
</head>
<body class="black">
    <?php include 'adminnav.php'; ?>

    <div class="content  " style="padding: 20px; margin-top: 50px; height: calc(100vh - 56px); overflow-y: auto;">
 

  <div class="container mt-5 py-5 ">
  <div class="row">
    <div class="col-md-6 mb-4" >
      <a href="department_programs.php" class="card-link">
        <div class="card square-card ">
          <div class="card-body d-flex flex-column justify-content-center">
            <h1 class="card-title text-center"><?php echo $department_programsCount; ?></h1>
            <H5 class="card-text text-center">DEPARTMENTS</H5>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-6 mb-4">
      <a href="programs_info.php" class="card-link">
        <div class="card square-card ">
          <div class="card-body d-flex flex-column justify-content-center">
            <h1 class="card-title text-center"><?php echo $program_infoCount; ?></h1>
            <H5 class="card-text text-center">PROGRAMS</H5>
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-4">
      <a href="events.php" class="card-link">
        <div class="card square-card">
          <div class="card-body d-flex flex-column justify-content-center">
            <h1 class="card-title text-center"><?php echo $eventsCount; ?></h1>
            <H5 class="card-text text-center">EVENTS</H5>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-6 mb-4">
      <a href="news.php" class="card-link">
        <div class="card square-card">
          <div class="card-body d-flex flex-column justify-content-center">
            <h1 class="card-title text-center"><?php echo $postsCount; ?></h1>
            <H5 class="card-text text-center">NEWS</H5>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
</div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
     <script>
document.addEventListener('DOMContentLoaded', () => {
    console.log('Initializing dropdown...');
    const dropdownToggle = document.getElementById('programsDropdown');
    
    if (!dropdownToggle) {
        console.error('Dropdown toggle element not found');
        return;
    }

    // Initialize dropdown once
    const dropdown = new bootstrap.Dropdown(dropdownToggle);

    dropdownToggle.addEventListener('click', (e) => {
        e.preventDefault();
        console.log('Dropdown clicked');
        dropdown.toggle();
    });

    // Debug dropdown state
    dropdownToggle.addEventListener('shown.bs.dropdown', () => {
        console.log('Dropdown shown');
    });

    dropdownToggle.addEventListener('hidden.bs.dropdown', () => {
        console.log('Dropdown hidden');
    });
});
</script> 
</body>
</html>