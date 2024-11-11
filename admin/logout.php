<?php
  session_start();
  if (isset($_SESSION['ID'])) {
    session_unset();
    session_destroy();
    echo "<script>
      alert('Logout Successful! Redirecting to login page.');
      window.location.href = '../index.php';
    </script>";
  } else {
   
    echo "<script>
      alert('You are not logged in. Please log in first.');
      window.location.href = '../index.php';
    </script>";
  }
?>
<!doctype html>
<html lang="en">
<head>
  <?php include('header.php'); ?>
  <title>Logout</title>
</head>
<body>
  </body>
</html>