<?php
require_once('../config.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // First get the image paths
    $sql = "SELECT mission_image, vision_image FROM aboutus_section WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    // Delete images if they exist
    if($row) {
        if(file_exists($row['mission_image'])) {
            unlink($row['mission_image']);
        }
        if(file_exists($row['vision_image'])) {
            unlink($row['vision_image']);
        }
    }
    
    // Delete record
    $sql = "DELETE FROM aboutus_section WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()) {
        header("Location: aboutus_section.php?delete=success");
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
} else {
    header("Location: aboutus_section.php");
}
?>