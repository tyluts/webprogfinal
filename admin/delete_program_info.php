<?php
require_once('../config.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Get image path before deletion
    $sql = "SELECT curriculum_image FROM program_info WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $program = $result->fetch_assoc();
    
    // Delete from database
    $sql = "DELETE FROM program_info WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()) {
        // Remove curriculum image file if exists
        if($program && !empty($program['curriculum_image']) && file_exists($program['curriculum_image'])) {
            unlink($program['curriculum_image']);
        }
        header("Location: programs_info.php?delete=success");
    } else {
        header("Location: programs_info.php?delete=error");
    }
} else {
    header("Location: programs_info.php");
}
?>