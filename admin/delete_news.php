<?php
require_once('../config.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Get photo path before deletion to remove file
    $sql = "SELECT photo FROM posts WHERE ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $news = $result->fetch_assoc();
    
    // Delete from database
    $sql = "DELETE FROM posts WHERE ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()) {
        // Remove photo file if exists
        if($news && !empty($news['photo']) && file_exists($news['photo'])) {
            unlink($news['photo']);
        }
        header("Location: news.php?delete=success");
    } else {
        header("Location: news.php?delete=error");
    }
} else {
    header("Location: news.php");
}