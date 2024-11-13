<?php
  require_once('../config.php');
  
  if (isset($_POST['click_view_deets'])) {
    $id = $_POST['user_id'];
    $eventsSql = "SELECT * FROM events WHERE ID = $id";
    $eventsSqlResult = $con->query($eventsSql);

    if($eventsSqlResult->num_rows > 0){
      while($row = $eventsSqlResult-> fetch_assoc()){
          echo '
          <h6> Title: '. $row['title'] .'</h6>
          <h6>Description: '. $row['description'] .'</h6>
          <h6>Date: '. $row['date'] .'</h6>
          <h6>Location: '. $row['loc'] .'</h6>
          ';
      }
    }else{
      echo 'No announcements found';
    }
      

  } else {
      echo "No data received";
  }



?>

