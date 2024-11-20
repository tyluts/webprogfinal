<?php
require_once('../config.php');

if(isset($_GET['id'])) {
    // Get image path first
    $stmt = $con->prepare("SELECT social_image FROM social_section WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    // Delete image file if exists
    if(!empty($row['social_image']) && file_exists($row['social_image'])) {
        unlink($row['social_image']);
    }
    
    // Delete record
    $stmt = $con->prepare("DELETE FROM social_section WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    
    if($stmt->execute()) {
        header("Location: social_section.php?success=3");
    }
}
?>