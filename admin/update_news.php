<?php
session_start();
require_once('../config.php');

// update_news.php - Fetch News Details
if (isset($_POST['edit_news'])) {
    $id = intval($_POST['news_id']);
    $arrayresult = [];
    $stmt = $con->prepare("SELECT * FROM posts WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $news_result = $stmt->get_result();

    if ($news_result->num_rows > 0) {
        while ($row = $news_result->fetch_assoc()) {
            array_push($arrayresult, $row);
        }
        header('Content-Type: application/json');
        echo json_encode($arrayresult); // Send JSON response after the loop
    } else {
        echo json_encode(['error' => 'No announcements found']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'No data received']);
}

// update_news.php - Update News Record
if (isset($_POST['news_update'])) {
    $ID = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['datetime'];

    $imagePath = null;

    // Image Upload Handling
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
            header('location: news.php');
            exit;
        }
    }

    // Update query - Corrected syntax
    $update_event = "UPDATE posts SET 
                     title = ?, 
                     caption = ?, 
                     img = COALESCE(?, img), 
                     date_posted = ? 
                     WHERE ID = ?";
                     
    $stmt = mysqli_prepare($con, $update_event);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssi", $title, $description, $imagePath, $date, $ID);
        $update_event_run = mysqli_stmt_execute($stmt);

        if ($update_event_run) {
            $_SESSION['status'] = "Event updated successfully";
            header('location: news.php');
        } else {
            $_SESSION['status'] = "Event was not updated successfully";
            header('location: news.php');
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['status'] = "Failed to prepare the update query";
        header('location: news.php');
    }
}
?>