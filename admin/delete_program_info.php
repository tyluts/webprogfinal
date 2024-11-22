<?php
// delete_program_info.php

require_once('../config.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        $delete_query = "DELETE FROM program_info WHERE id = ?";
        $delete_stmt = $con->prepare($delete_query);
        $delete_stmt->bind_param("i", $id);
        
        if($delete_stmt->execute()) {
            header('Location: programs_info.php');
            exit();
        } else {
            throw new Exception("Error deleting record: " . $delete_stmt->error);
        }
        
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo "<script>
                alert('Error deleting program: " . addslashes($e->getMessage()) . "');
                window.location.href = 'programs_info.php';
              </script>";
    }
}
?>