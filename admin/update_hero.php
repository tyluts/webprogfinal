<?php
require_once('../config.php');

if(isset($_POST['get_hero'])) {
    $id = $_POST['hero_id'];
    $sql = "SELECT * FROM hero_section WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result->fetch_assoc());
    exit();
}

if(isset($_POST['update_hero'])) {
    $id = $_POST['id'];
    $title = $_POST['hero_title'];
    $desc = $_POST['hero_desc'];
    $button = $_POST['button_text'];
    
    if(isset($_FILES['hero_img']) && $_FILES['hero_img']['error'] == 0) {
        $image = $_FILES['hero_img'];
        $imageName = basename($image['name']);
        $uploadDir = 'img/hero/';
        $targetFilePath = $uploadDir . $imageName;
        
        if(move_uploaded_file($image['tmp_name'], $targetFilePath)) {
            $sql = "UPDATE hero_section SET hero_img=?, hero_title=?, hero_desc=?, button_text=? WHERE id=?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssssi", $targetFilePath, $title, $desc, $button, $id);
        }
    } else {
        $sql = "UPDATE hero_section SET hero_title=?, hero_desc=?, button_text=? WHERE id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssi", $title, $desc, $button, $id);
    }
    
    if($stmt->execute()) {
        header("Location: hero_section.php?update=success");
    }
}