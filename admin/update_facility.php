<?php

require_once('../config.php');

if(isset($_POST['get_facility'])) {
    $id = $_POST['facility_id'];
    $sql = "SELECT * FROM facilities_section WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result->fetch_assoc());
    exit();
}

if(isset($_POST['update_facility'])) {
    $id = $_POST['id'];
    $facility_title = $_POST['facility_title'];
    $facility_desc = $_POST['facility_desc'];

    // Update base data
    $stmt = $con->prepare("UPDATE facilities_section SET facility_title = ?, facility_desc = ? WHERE id = ?");
    $stmt->bind_param("ssi", $facility_title, $facility_desc, $id);
    $stmt->execute();

    // Handle image updates
    for($i = 1; $i <= 5; $i++) {
        if(isset($_FILES['facility_image'.$i]) && $_FILES['facility_image'.$i]['error'] == 0) {
            $image = $_FILES['facility_image'.$i];
            $uploadDir = 'img/facilities/';
            $imageName = time() . '_' . $i . '_' . basename($image['name']);
            $targetPath = $uploadDir . $imageName;
            
            if(move_uploaded_file($image['tmp_name'], $targetPath)) {
                $imgField = 'facility_image'.$i;
                $stmt = $con->prepare("UPDATE facilities_section SET $imgField = ? WHERE id = ?");
                $stmt->bind_param("si", $targetPath, $id);
                $stmt->execute();
            }
        }
    }
    
    header("Location: facilities_section.php");
}
?>