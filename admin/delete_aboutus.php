<?php
require_once('../config.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM aboutus_section WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()) {
        header("Location: aboutus_section.php?delete=success");
    } else {
        header("Location: aboutus_section.php?delete=error");
    }
} else {
    header("Location: aboutus_section.php");
}