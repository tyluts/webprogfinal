<?php
// update_aboutus.php

require_once('../config.php');

// Get aboutus details for edit
if(isset($_POST['get_aboutus'])) {
    $id = $_POST['aboutus_id'];
    $sql = "SELECT * FROM aboutus_section WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result->fetch_assoc());
    exit();
}

// Update aboutus
if(isset($_POST['update_aboutus'])) {
    $id = $_POST['id'];
    $mission_title = $_POST['mission_title'];
    $mission_desc = $_POST['mission_desc'];
    $vision_title = $_POST['vision_title'];
    $vision_desc = $_POST['vision_desc'];
    
    // Handle mission image
    $mission_image = $_POST['current_mission_image'];
    if(isset($_FILES['mission_image']) && $_FILES['mission_image']['error'] == 0) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $mission_image = $target_dir . time() . '_' . basename($_FILES["mission_image"]["name"]);
        move_uploaded_file($_FILES["mission_image"]["tmp_name"], $mission_image);
        
        // Delete old image
        if(file_exists($_POST['current_mission_image'])) {
            unlink($_POST['current_mission_image']);
        }
    }
    
    // Handle vision image
    $vision_image = $_POST['current_vision_image'];
    if(isset($_FILES['vision_image']) && $_FILES['vision_image']['error'] == 0) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $vision_image = $target_dir . time() . '_' . basename($_FILES["vision_image"]["name"]);
        move_uploaded_file($_FILES["vision_image"]["tmp_name"], $vision_image);
        
        // Delete old image
        if(file_exists($_POST['current_vision_image'])) {
            unlink($_POST['current_vision_image']);
        }
    }
    
    $sql = "UPDATE aboutus_section SET mission_title=?, mission_desc=?, mission_image=?, vision_title=?, vision_desc=?, vision_image=? WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssssi", $mission_title, $mission_desc, $mission_image, $vision_title, $vision_desc, $vision_image, $id);
    
    if($stmt->execute()) {
        header("Location: aboutus_section.php?update=success");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

