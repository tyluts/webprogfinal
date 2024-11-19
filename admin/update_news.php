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
            header('Content-Type: application/json');
            echo json_encode($arrayresult); 
        }

    } else {
        echo json_encode(['error' => 'No announcements found']);
    }

} else {
    echo json_encode(['error' => 'No data received']);
}


if (isset($_POST['news_update'])) {
    $ID = intval($_POST['id']);
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date_time = date('Y-m-d');
    $imagePath = $targetFilePath ?: null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $uploadDir = 'img/';
        $imageName = basename($image['name']);
        $imageTmpPath = $image['tmp_name'];
        $targetFilePath = $uploadDir . $imageName;

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($imageTmpPath, $targetFilePath)) {
            $imagePath = $targetFilePath;
        } else {
            $_SESSION['status'] = "Image upload failed";
            header('location: news.php');
            exit;
        }
    }

    $update_news = "UPDATE posts SET 
                     title = ?, 
                     caption = ?, 
                     photo = COALESCE(?, photo),
                     date_posted = ? 
                     WHERE ID = ?";
                     
    $stmt = mysqli_prepare($con, $update_news);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssi", $title, $description, $imagePath, $date_time, $ID);

        $update_news_run = mysqli_stmt_execute($stmt);

        if ($update_news_run) {
            echo 'successful';
            header('location: news.php');
        } else {
            echo 'eeeeeeeeeeeeeeeengggggggg';
            header('location: news.php');
        }

        mysqli_stmt_close($stmt);
    } else {
       echo 'sira sql bai';
        header('location: news.php');
    }
}

?>
