<?php
require_once('../config.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Get current images
    $sql = "SELECT * FROM facilities_section WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $facility = $result->fetch_assoc();
    
    // Delete image files
    for($i = 1; $i <= 5; $i++) {
        $imgField = 'facility_image'.$i;
        if(!empty($facility[$imgField]) && file_exists($facility[$imgField])) {
            unlink($facility[$imgField]);
        }
    }
    
    // Delete record
    $stmt = $con->prepare("DELETE FROM facilities_section WHERE id = ?");
    $stmt->bind_param("i", $id);
    if($stmt->execute()) {
        header("Location: facilities_section.php");
        exit();
    }
}
?>