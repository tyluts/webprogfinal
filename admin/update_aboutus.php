<?php
require_once('../config.php');

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

if(isset($_POST['update_aboutus'])) {
    $id = $_POST['id'];
    $mission_title = $_POST['mission_title'];
    $mission_desc = $_POST['mission_desc'];
    $vision_title = $_POST['vision_title'];
    $vision_desc = $_POST['vision_desc'];
    
    $sql = "UPDATE aboutus_section SET mission_title=?, mission_desc=?, vision_title=?, vision_desc=? WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssi", $mission_title, $mission_desc, $vision_title, $vision_desc, $id);
    
    if($stmt->execute()) {
        header("Location: aboutus_section.php?update=success");
    }
}