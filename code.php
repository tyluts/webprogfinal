<?php
session_start();
require_once('config.php');


if (isset($_POST['click_deets'])) {

    $id = intval($_POST['user_id']);
    
    $stmt = $con->prepare("SELECT * FROM events WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $eventsSqlResult = $stmt->get_result();


    if ($eventsSqlResult->num_rows > 0) {
        while ($row = $eventsSqlResult->fetch_assoc()) {
            echo '
            <img src="./admin/'. htmlspecialchars($row['img']) .'" alt="Event Image" class="enlarged-image" />
            <h6>Title: '. htmlspecialchars($row['title']) .'</h6>
            <h6>Description: '. htmlspecialchars($row['description']) .'</h6>
            <h6>Date: '. htmlspecialchars($row['date']) .'</h6>
            <h6>Location: '. htmlspecialchars($row['loc']) .'</h6>
            ';
        }
    } else {
        echo 'No announcements found';
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No data received";
}

if (isset($_POST['news_deets'])) {

    $id = intval($_POST['news_id']);
    
    $stmt = $con->prepare("SELECT * FROM posts WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $eventsSqlResult = $stmt->get_result();


    if ($eventsSqlResult->num_rows > 0) {
        while ($row = $eventsSqlResult->fetch_assoc()) {
            echo '
            <img src="./admin/'. htmlspecialchars($row['photo']) .'" alt="Event Image" class="enlarged-image" />
            <h6>Title: '. htmlspecialchars($row['title']) .'</h6>
            <h6>Description: '. htmlspecialchars($row['caption']) .'</h6>
            <h6>Date: '. htmlspecialchars($row['date_posted']) .'</h6>
            ';
        }
    } else {
        echo 'No announcements found';
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No data received";
}

?>
