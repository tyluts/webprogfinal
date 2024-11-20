<?php
// update_program.php

require_once('../config.php');

if(isset($_POST['get_program'])) {
    $id = $_POST['program_id'];
    $query = "SELECT * FROM department_programs WHERE id=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    echo json_encode($data);
    exit();
}

if(isset($_POST['update_program'])) {
    $id = $_POST['id'];
    $department_title = $_POST['department_title'];
    $course_title = $_POST['course_title'];
    $button_text = $_POST['button_text'];

    if(isset($_FILES['department_image']) && $_FILES['department_image']['error'] == 0) {
        $image = $_FILES['department_image'];
        $imageName = basename($image['name']);
        $uploadDir = 'img/departments/';
        $targetFilePath = $uploadDir . $imageName;

        if(move_uploaded_file($image['tmp_name'], $targetFilePath)) {
            $query = "UPDATE department_programs SET department_title=?, course_title=?, button_text=?, department_image=? WHERE id=?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("ssssi", $department_title, $course_title, $button_text, $targetFilePath, $id);
        }
    } else {
        $query = "UPDATE department_programs SET department_title=?, course_title=?, button_text=? WHERE id=?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("sssi", $department_title, $course_title, $button_text, $id);
    }

    if($stmt->execute()) {
        header("Location: department_programs.php");
    }
}
?>