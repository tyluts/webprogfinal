<?php
require_once('../config.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // First check if record exists
    $checkSql = "SELECT id FROM social_section WHERE id = ?";
    $checkStmt = $con->prepare($checkSql);
    $checkStmt->bind_param("i", $id);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    
    if($result->num_rows > 0) {
        // Record exists, proceed with deletion
        $sql = "DELETE FROM social_section WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if($stmt->execute()) {
            // Success - redirect with success message
            header("Location: social_section.php?delete=success");
            exit();
        } else {
            // Database error
            header("Location: social_section.php?delete=error&message=".urlencode($con->error));
            exit();
        }
    } else {
        // Record not found
        header("Location: social_section.php?delete=error&message=record_not_found");
        exit();
    }
} else {
    // No ID provided
    header("Location: social_section.php?delete=error&message=no_id");
    exit();
}

// Close database connection

?>