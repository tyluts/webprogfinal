<?php
require_once('../config.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Get image path before deletion to remove file
    $sql = "SELECT img FROM events WHERE ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();
    
    // Delete from database
    $sql = "DELETE FROM events WHERE ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()) {
        // Remove image file if exists
        if($event && !empty($event['img']) && file_exists($event['img'])) {
            unlink($event['img']);
        }
        header("Location: events.php?delete=success");
    } else {
        header("Location: events.php?delete=error");
    }
} else {
    header("Location: events.php");
}