<?php


require_once('../config.php');

if(isset($_POST['get_program'])) {
    $id = $_POST['program_id'];
    $query = "SELECT * FROM program_info WHERE id=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    echo json_encode($row);
    exit();
}

// Handle form submission for update
if(isset($_POST['update_program'])) {
    try {
        $id = $_POST['id'];
        $program_title = $_POST['program_title'];
        $program_desc = $_POST['program_desc'];
        $course_code = $_POST['course_code'];
        $dept_code = $_POST['dept_code'];
        // Base query
        $query = "UPDATE program_info SET 
                 program_title = ?,
                 program_desc = ?,
                 course_code = ?,
                 dept_code = ?";
        $types = "ssss";
        $params = [$program_title, $program_desc, $course_code, $dept_code];

        $query .= " WHERE id = ?";
        $types .= "i";
        $params[] = $id;

        // Prepare and execute update
        $stmt = $con->prepare($query);
        $stmt->bind_param($types, ...$params);
        
        if($stmt->execute()) {
            header("Location: programs_info.php");
            exit();
        } else {
            throw new Exception("Error executing update: " . $stmt->error);
        }

    } catch (Exception $e) {
        error_log($e->getMessage());
        echo "<script>
                alert('Error updating program: " . addslashes($e->getMessage()) . "');
                window.location.href = 'programs_info.php';
              </script>";
    }
}
?>