<?php
require_once('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_program']) && isset($_POST['program_id'])) {
    $program_id = $_POST['program_id'];

    // Perform the deletion (soft delete or actual delete)
    $stmt = $con->prepare("DELETE FROM top_programs WHERE id = ?");
    if ($stmt === false) {
        echo "error: " . $con->error;
        exit;
    }

    $stmt->bind_param("i", $program_id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "error: Invalid request";
}
?>