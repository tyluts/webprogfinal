<?php
require_once('../config.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM department_programs WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()) {
        header("Location: department_programs.php?delete=success");
    } else {
        header("Location: department_programs.php?delete=error");
    }
} else {
    header("Location: department_programs.php");
}