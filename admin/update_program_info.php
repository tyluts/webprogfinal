<?php
require_once('../config.php');

if(isset($_POST['get_program'])) {
    $id = $_POST['program_id'];
    $sql = "SELECT * FROM program_info WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result->fetch_assoc());
    exit();
}

if(isset($_POST['update_program'])) {
    $id = $_POST['id'];
    $program_title = $_POST['program_title'];
    $program_desc = $_POST['program_desc'];
    $curriculum_title = $_POST['curriculum_title'];
    $curriculum_image_title = $_POST['curriculum_image_title'];
    
    if(isset($_FILES['curriculum_image']) && $_FILES['curriculum_image']['error'] == 0) {
        $image = $_FILES['curriculum_image'];
        $imageName = basename($image['name']);
        $uploadDir = 'img/curriculum/';
        $targetFilePath = $uploadDir . $imageName;
        
        if(move_uploaded_file($image['tmp_name'], $targetFilePath)) {
            $sql = "UPDATE program_info SET program_title=?, program_desc=?, curriculum_title=?, curriculum_image_title=?, curriculum_image=? WHERE id=?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sssssi", $program_title, $program_desc, $curriculum_title, $curriculum_image_title, $targetFilePath, $id);
        }
    } else {
        $sql = "UPDATE program_info SET program_title=?, program_desc=?, curriculum_title=?, curriculum_image_title=? WHERE id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssi", $program_title, $program_desc, $curriculum_title, $curriculum_image_title, $id);
    }
    
    if($stmt->execute()) {
        header("Location: programs_info.php?update=success");
    }
}