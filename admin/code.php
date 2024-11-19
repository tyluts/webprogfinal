<?php
    session_start();
    require_once('../config.php');
    /////////update events
    if (isset($_POST['edit_deets'])) {

        $id = intval($_POST['event_id']);
        $arrayresult = [];
        $stmt = $con->prepare("SELECT * FROM events WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $eventsSqlResult = $stmt->get_result();
    
    
        if ($eventsSqlResult->num_rows > 0) {
            while ($row = $eventsSqlResult->fetch_assoc()) {
               array_push($arrayresult, $row);
               header('content-type: application/json');
               echo json_encode($arrayresult);
            }
        } else {
            echo 'No announcements found';
        }
    

       
    } else {
        echo "No data received";
    }


if (isset($_POST['update_event'])) {
    $ID = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['datetime'];
    $loc = $_POST['loc'];

    $imagePath = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $imageName = basename($image['name']);
        $imageTmpPath = $image['tmp_name'];
        $uploadDir = 'img/';
        
        $targetFilePath = $uploadDir . $imageName;
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        if (move_uploaded_file($imageTmpPath, $targetFilePath)) {
            $imagePath = $targetFilePath; // Store the path for the database update
        } else {
            $_SESSION['status'] = "Image upload failed";
            header('location: events.php');
            exit;
        }
    }

    
    $update_event = "UPDATE events SET 
                     title = ?, 
                     description = ?, 
                     img = COALESCE(?, img), 
                     date = ?, 
                     loc = ? 
                     WHERE ID = ?";
                     
    $stmt = mysqli_prepare($con, $update_event);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssi", $title, $description, $imagePath, $date, $loc, $ID);
        $update_event_run = mysqli_stmt_execute($stmt);

        if ($update_event_run) {
            $_SESSION['status'] = "Event updated successfully";
            header('location: events.php');
        } else {
            $_SESSION['status'] = "Event was not updated successfully";
            header('location: events.php');
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['status'] = "Failed to prepare the update query";
        header('location: events.php');
    }
}

if(isset($_POST['checking_edit_btn'])) {
    $event_id = $_POST['event_id'];
    $query = "SELECT * FROM events WHERE ID = '$event_id'";
    $query_run = mysqli_query($con, $query);
    
    if(mysqli_num_rows($query_run) > 0) {
        while($row = mysqli_fetch_array($query_run)) {
            echo json_encode(array('status' => 200, 'data' => $row));
        }
    }
}


?>


