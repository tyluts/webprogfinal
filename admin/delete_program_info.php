<?php
// delete_program_info.php

require_once('../config.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // Get all image paths before deleting
        $query = "SELECT curriculum_image, curriculum_image2, curriculum_image3, curriculum_image4 
                 FROM program_info WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        // Delete all associated images
        if($row) {
            foreach($row as $image_path) {
                if(!empty($image_path) && file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        }
        
        // Delete the database record
        $delete_query = "DELETE FROM program_info WHERE id = ?";
        $delete_stmt = $con->prepare($delete_query);
        $delete_stmt->bind_param("i", $id);
        
        if($delete_stmt->execute()) {
            header('Location: program_info.php');
            exit();
        } else {
            throw new Exception("Error deleting record: " . $delete_stmt->error);
        }
        
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo "<script>
                alert('Error deleting program: " . addslashes($e->getMessage()) . "');
                window.location.href = 'program_info.php';
              </script>";
    }
}
?>