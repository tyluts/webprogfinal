<?php
// update_program_info.php

require_once('../config.php');

// Handle AJAX request to get program data
if(isset($_POST['get_program'])) {
    $id = $_POST['program_id'];
    $query = "SELECT * FROM program_info WHERE id=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    echo json_encode($row);
    exit();
}

// Handle form submission for update
if(isset($_POST['update_program'])) {
    try {
        $id = $_POST['id'];
        $program_title = $_POST['program_title'];
        $program_desc = $_POST['program_desc'];

        // Base query
        $query = "UPDATE program_info SET 
                 program_title = ?,
                 program_desc = ?";
        
        $types = "ss";
        $params = [$program_title, $program_desc];

        // Handle curriculum images
        for($i = 1; $i <= 4; $i++) {
            $image_field = 'curriculum_image' . ($i == 1 ? '' : $i);

            // Handle new image upload
            if(isset($_FILES[$image_field]) && $_FILES[$image_field]['error'] == 0) {
                $image = $_FILES[$image_field];
                $imageName = time() . '_' . basename($image['name']);
                $uploadDir = 'img/curriculum/';
                $targetFilePath = $uploadDir . $imageName;

                if(!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                if(move_uploaded_file($image['tmp_name'], $targetFilePath)) {
                    // Delete old image if exists
                    $old_query = "SELECT {$image_field} FROM program_info WHERE id = ?";
                    $old_stmt = $con->prepare($old_query);
                    $old_stmt->bind_param("i", $id);
                    $old_stmt->execute();
                    $old_result = $old_stmt->get_result();
                    $old_data = $old_result->fetch_assoc();
                    
                    if($old_data && !empty($old_data[$image_field])) {
                        $old_file = $old_data[$image_field];
                        if(file_exists($old_file)) {
                            unlink($old_file);
                        }
                    }

                    // Add new image to query
                    $query .= ", {$image_field} = ?";
                    $types .= "s";
                    $params[] = $targetFilePath;
                }
            }
        }

        // Add WHERE clause
        $query .= " WHERE id = ?";
        $types .= "i";
        $params[] = $id;

        // Prepare and execute update
        $stmt = $con->prepare($query);
        $stmt->bind_param($types, ...$params);
        
        if($stmt->execute()) {
            header("Location: programs_info.php");
            exit();
        } else {
            throw new Exception("Error executing update: " . $stmt->error);
        }

    } catch (Exception $e) {
        error_log($e->getMessage());
        echo "<script>
                alert('Error updating program: " . addslashes($e->getMessage()) . "');
                window.location.href = 'programs_info.php';
              </script>";
    }
}
?>