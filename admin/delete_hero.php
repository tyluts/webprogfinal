<?php
require_once('../config.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Get image path before deletion
    $sql = "SELECT hero_img FROM hero_section WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $hero = $result->fetch_assoc();
    
    // Delete from database
    $sql = "DELETE FROM hero_section WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()) {
        // Remove image file if exists
        if($hero && !empty($hero['hero_img']) && file_exists($hero['hero_img'])) {
            unlink($hero['hero_img']);
        }
        header("Location: hero_section.php?delete=success");
    } else {
        header("Location: hero_section.php?delete=error");
    }
} else {
    header("Location: hero_section.php");
}
?>