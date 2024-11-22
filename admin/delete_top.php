<?php
require_once('../config.php');

// Handle delete request
if (isset($_POST['delete_program'])) {
    $id = $_POST['program_id'];
    
    // Delete program
    $stmt = $con->prepare("DELETE FROM top_programs WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
