<?php
require_once('../config.php');
$programSql = "SELECT * FROM program_info";
$programSqlResult = $con->query($programSql);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['program_form'])) {
    $program_title = $_POST['program_title'];
    $program_desc = $_POST['program_desc'];
    $course_code = $_POST['course_code'];
    $dept_code = $_POST['dept_code'];

    // Handle multiple images
    $images = [];
    for ($i = 1; $i <= 4; $i++) {
        $field_name = 'curriculum_image' . ($i == 1 ? '' : $i);
        if (isset($_FILES[$field_name]) && $_FILES[$field_name]['error'] == 0) {
            $image = $_FILES[$field_name];
            $imageName = time() . '_' . basename($image['name']);
            $uploadDir = 'img/curriculum/';
            $targetFilePath = $uploadDir . $imageName;

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
                $images[$field_name] = $targetFilePath;
            } else {
                $images[$field_name] = null; // If upload fails
            }
        } else {
            $images[$field_name] = null; // If no file uploaded
        }
    }

    // Assign images to variables
    $curriculum_image1 = $images['curriculum_image'] ?? null;
    $curriculum_image2 = $images['curriculum_image2'] ?? null;
    $curriculum_image3 = $images['curriculum_image3'] ?? null;
    $curriculum_image4 = $images['curriculum_image4'] ?? null;

    // Prepare the SQL statement
    $stmt = $con->prepare("INSERT INTO program_info (program_title, program_desc, course_code, curriculum_image1, curriculum_image2, curriculum_image3, curriculum_image4, dept_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "ssssssss",
        $program_title,
        $program_desc,
        $course_code,
        $curriculum_image1,
        $curriculum_image2,
        $curriculum_image3,
        $curriculum_image4,
        $dept_code
    );

    // Execute the query
    if ($stmt->execute()) {
        header("Location: programs_info.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    
    <!-- CoreUI CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.2.0/dist/css/coreui.min.css" rel="stylesheet"  crossorigin="anonymous">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Boxicons -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/homecss/color.css">
    <link rel="stylesheet" href="css/homecss/nav.css">
    <link rel="stylesheet" href="css/homecss/footer.css">
    <link rel="stylesheet" href="css/homecss/card.css">
    <link rel="stylesheet" href="css/homecss/video.css">
    <link rel="stylesheet" href="css/homecss/contactform.css">
    <link rel="stylesheet" href="css/programcss/accordion.css">
    <link rel="stylesheet" href="css/eventscss/grid.css">
    <link rel="stylesheet" href="css/aboutuscss/carousel.css">
    <link rel="stylesheet" href="css/aboutuscss/grid.css">
    <link rel="stylesheet" href="css/colors.css">
    <style>
    .modal-backdrop {
        display: none !important;
    }

   
 :root {
    --sidebar-width: 250px;
}

.main-container {
    margin-left: var(--sidebar-width);
    width: calc(100% - var(--sidebar-width));
    padding: 1.5rem;
    overflow-x: auto;
    
}

.table-wrapper {
    background: white;
    border-radius: 0.25rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
    min-width: 800px;
}

.text-wrap {
    word-break: break-word;
    white-space: normal;
}

@media screen and (max-width: 991.98px) {
    .main-container {
        margin-left: 0;
        width: 100%;
        padding: 1rem;
    }

    .table-wrapper {
        min-width: auto;
    }

    .table-responsive thead {
        
    }

    .table-responsive tbody tr {
        display: block;
        margin-bottom: 1rem;
        border: 1px solid #dee2e6;
    }

    .table-responsive tbody td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem !important;
        border: none;
        border-bottom: 1px solid #dee2e6;
    }

    .table-responsive tbody td:before {
        content: attr(data-label);
        font-weight: bold;
        margin-right: 1rem;
    }

    .table-responsive .text-wrap {
        max-width: none !important;
        text-align: right;
    }

    .table-responsive .btn-group {
        width: 100%;
        justify-content: flex-end;
    }

    .table-responsive img {
        margin-left: auto;
    }
        .table-responsive thead tr:first-child {
        
        position: sticky;
        top: 0;
        z-index: 10;
    }
    
    .table-responsive thead tr:not(:first-child) {
        display: none;
    }
}

    </style>
</head>
</head>
<body class="black">
    <?php include 'adminnav.php'; ?>

    <!-- Add Program Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Program Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="program_form">
                        <div class="mb-3">
                            <label class="form-label">Program Title</label>
                            <input type="text" class="form-control" name="program_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Program Description</label>
                            <textarea class="form-control" name="program_desc" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Department Code</label>
                            <input type="text" class="form-control" name="dept_code" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course Code</label>
                            <input type="text" class="form-control" name="course_code" required>
                        </div>
                        <?php for($i = 1; $i <= 4; $i++) : ?>
                            <div class="mb-3">
                                <label class="form-label">Curriculum Image <?php echo $i; ?></label>
                                <input type="file" class="form-control" 
                                       name="curriculum_image<?php echo $i > 1 ? $i : ''; ?>" 
                                       accept="image/*" required>
                            </div>
                        <?php endfor; ?>
                        <button type="submit" class="btn btn-primary w-100">Add Program</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Program Modal -->
    <div class="modal fade" id="editProgramModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Program Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="update_program_info.php">
                        <input type="hidden" name="id" class="program_id">
                        <div class="mb-3">
                            <label class="form-label">Program Title</label>
                            <input type="text" class="form-control program_title" name="program_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Program Description</label>
                            <textarea class="form-control program_desc" name="program_desc" rows="3" required></textarea>
                        </div>
                        <?php for($i = 1; $i <= 4; $i++) : ?>
                            <div class="mb-3">
                                <label class="form-label">Curriculum Image <?php echo $i; ?></label>
                                <input type="file" class="form-control" 
                                       name="curriculum_image<?php echo $i > 1 ? $i : '1'; ?>" 
                                       accept="image/*">
                                <img id="imagePreview<?php echo $i; ?>" src="#" 
                                     class="mt-2 w-100" style="display: none;">
                            </div>
                        <?php endfor; ?>
                        <button type="submit" name="update_program" class="btn btn-primary w-100">Update Program</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <div class="table-wrapper">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th colspan="8" class="bg-light">
                                <div class="d-flex justify-content-between align-items-center p-2">
                                    <h5 class="mb-0">Program Information</h5>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Add Program
                                    </button>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Program Title</th>
                            <th>Description</th>
                            <th>Curriculum Images</th>
                            <th>Department Code</th>
                            <th>Course Code</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($programSqlResult)) { ?>
                            <tr>
                                <td class="program_id" data-label="ID"><?php echo $row['id']; ?></td>
                                <td data-label="Program Title"><?php echo htmlspecialchars($row['program_title']); ?></td>
                                <td data-label="Description"><?php echo htmlspecialchars($row['program_desc']); ?></td>
                                <td data-label="Curriculum Images">
                                    <div class="d-flex gap-2 flex-wrap">
                                        <?php for($i = 1; $i <= 4; $i++) : 
                                            $img_field = 'curriculum_image' . ($i == 1 ? '1' : $i);
                                            if(!empty($row[$img_field])) : ?>
                                                <img src="<?php echo htmlspecialchars($row[$img_field]); ?>" 
                                                     alt="Curriculum <?php echo $i; ?>" 
                                                     style="max-width: 50px; height: auto;">
                                        <?php endif; endfor; ?>
                                    </div>
                                </td>
                                <td data-label="Department Code"><?php echo htmlspecialchars($row['dept_code']); ?></td>
                                <td data-label="Course Code"><?php echo htmlspecialchars($row['course_code']); ?></td>
                                <td>
                                <td>
                                    <a class="btn btn-sm btn-warning mx-1 edit_program">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="delete_program_info.php?id=<?php echo $row['id']; ?>" 
                                       class="btn btn-sm btn-danger mx-1" 
                                       onclick="return confirm('Are you sure?');">
                                        <i class="bi bi-trash3"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    $(document).ready(function() {
        $('.edit_program').click(function(e) {
            e.preventDefault();
            var id = $(this).closest('tr').find('.program_id').text();
            
            $.ajax({
                method: "POST",
                url: "update_program_info.php",
                data: {
                    'get_program': true,
                    'program_id': id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    $('.program_id').val(data.id);
                    $('.program_title').val(data.program_title);
                    $('.program_desc').val(data.program_desc);
                    
                    // Show existing images
                    for(var i = 1; i <= 4; i++) {
                        var imgField = 'curriculum_image' + (i == 1 ? '1' : i);
                        if(data[imgField]) {
                            $('#imagePreview' + i)
                                .attr('src', data[imgField])
                                .show();
                        }
                    }
                    
                    $('#editProgramModal').modal('show');
                }
            });
        });
    });
    </script>
</body>
</html>