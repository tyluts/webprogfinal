<?php
require_once('../config.php');

if(isset($_POST['get_social'])) {
    $id = $_POST['social_id'];
    $sql = "SELECT * FROM social_section WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result->fetch_assoc());
    exit();
}

if(isset($_POST['update_social'])) {
    $id = $_POST['id'];
    $title = $_POST['social_title'];
    $desc = $_POST['social_desc'];
    $icon = $_POST['social_icon'];
    
    $sql = "UPDATE social_section SET social_title=?, social_desc=?, social_icon=? WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssi", $title, $desc, $icon, $id);
    
    if($stmt->execute()) {
        header("Location: social_section.php?update=success");
    }
}