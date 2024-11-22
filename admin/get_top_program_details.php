<?php
require_once('../config.php');

if (isset($_POST['get_program']) && isset($_POST['program_id'])) {
    $id = $_POST['program_id'];
    
    $stmt = $con->prepare("SELECT * FROM top_programs WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Fetch data
    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Program not found']);
    }
}
?>
