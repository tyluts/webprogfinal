<?php
session_start();
require_once('../config.php');

// Fetch Event Details
if (isset($_POST['edit_deets'])) {
    $id = intval($_POST['event_id']);
    $arrayresult = [];
    
    $stmt = $con->prepare("SELECT * FROM events WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $event_result = $stmt->get_result();

    if ($event_result->num_rows > 0) {
        while ($row = $event_result->fetch_assoc()) {
            array_push($arrayresult, $row);
        }
        header('Content-Type: application/json');
        echo json_encode($arrayresult);
    } else {
        echo json_encode(['error' => 'No event found']);
    }
} else {
    echo json_encode(['error' => 'No data received']);
}

// Update Event
if (isset($_POST['update_event'])) {
    $ID = intval($_POST['id']);
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['datetime'];
    $loc = $_POST['loc'];
    $imagePath = null;

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $uploadDir = 'img/';
        $imageName = time() . '_' . basename($image['name']);
        $imageTmpPath = $image['tmp_name'];
        $targetFilePath = $uploadDir . $imageName;

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($imageTmpPath, $targetFilePath)) {
            $imagePath = $targetFilePath;
        }
    }

    // Prepare update query
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
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['status'] = "Event updated successfully";
        } else {
            $_SESSION['status'] = "Update failed: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    }
    
    header('Location: events.php');
    exit();
}
?>