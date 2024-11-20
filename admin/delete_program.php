<?php
// delete_program.php

require_once('../config.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Get image path before deletion
    $query = "SELECT department_image FROM department_programs WHERE id=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    
    // Delete from database
    $delete_query = "DELETE FROM department_programs WHERE id=?";
    $stmt = $con->prepare($delete_query);
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()) {
        // Delete image file if exists
        if(!empty($data['department_image']) && file_exists($data['department_image'])) {
            unlink($data['department_image']);
        }
        header("Location: department_programs.php");
    }
}
?>