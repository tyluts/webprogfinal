<?php
require_once('../config.php');

if(isset($_POST['get_program'])) {
    $id = $_POST['program_id'];
    $sql = "SELECT * FROM department_programs WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    echo json_encode($row);
    exit();
}

if(isset($_POST['update_program'])) {
    $id = $_POST['id'];
    $department = $_POST['department_title'];
    $course = $_POST['course_title'];
    $button = $_POST['button_text'];

    $sql = "UPDATE department_programs SET department_title=?, course_title=?, button_text=? WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssi", $department, $course, $button, $id);
    
    if($stmt->execute()) {
        header("Location: department_programs.php?update=success");
    }
}