<?php
require_once('../config.php');

if(isset($_POST['get_social'])) {
    $id = $_POST['social_id'];
    $query = "SELECT * FROM social_section WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    echo json_encode($data);
    exit();
}

if(isset($_POST['update_social'])) {
    $id = $_POST['id'];
    $title = $_POST['social_title'];
    $description = $_POST['social_desc'];
    $icon = $_POST['social_icon'];
    
    // Handle image upload
    $image_sql = "";
    $params = "sssi";
    $values = [$title, $description, $icon, $id];
    
    if(isset($_FILES['social_image']) && $_FILES['social_image']['error'] == 0) {
        $target_dir = "uploads/social/";
        if(!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $image = $target_dir . basename($_FILES["social_image"]["name"]);
        move_uploaded_file($_FILES["social_image"]["tmp_name"], $image);
        $image_sql = ", social_image = ?";
        $params = "ssssi";
        $values = [$title, $description, $icon, $image, $id];
    }

    $stmt = $con->prepare("UPDATE social_section SET social_title = ?, social_desc = ?, social_icon = ?" . $image_sql . " WHERE id = ?");
    $stmt->bind_param($params, ...$values);
    
    if($stmt->execute()) {
        header("Location: social_section.php?success=2");
    }
}
?>