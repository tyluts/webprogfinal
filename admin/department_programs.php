<?php
require_once('../config.php');
$programSql = "SELECT * FROM department_programs";
$programSqlResult = $con->query($programSql);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['program_form'])) {
    $department_title = $_POST['department_title'];
    $dept_code = $_POST['dept_code'];
    $dept_desc = $_POST['dept_desc'];
    $button_text = $_POST['button_text'];

    if (isset($_FILES['department_image']) && $_FILES['department_image']['error'] == 0) {
        $image = $_FILES['department_image'];
        $imageName = basename($image['name']);
        $imageTmpPath = $image['tmp_name'];
        $uploadDir = 'img/departments/';

        $targetFilePath = $uploadDir . $imageName;
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($imageTmpPath, $targetFilePath)) {
            $stmt = $con->prepare("INSERT INTO department_programs (department_title, button_text, department_imagem, dept_code, dept_desc) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $department_title, $button_text, $targetFilePath, $dept_code, $dept_code);

            if ($stmt->execute()) {
                header("Refresh: 1; url=department_programs.php");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
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

<body class="bg-dark">
    <?php include 'adminnav.php'; ?>

    <!-- Add Program Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="program_form">
                        <div class="mb-3">
                            <label class="form-label">Department Title</label>
                            <input type="text" class="form-control" name="department_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Department Description</label>
                            <input type="text" class="form-control" name="dept_desc" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Department Code</label>
                            <input type="text" class="form-control" name="dept_code" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Button Text</label>
                            <input type="text" class="form-control" name="button_text" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Department Image</label>
                            <input type="file" class="form-control" name="department_image" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add Department</button>
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
                    <h5 class="modal-title">Edit Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="update_program.php">
                        <input type="hidden" name="id" class="program_id">
                        <div class="mb-3">
                            <label class="form-label">Department Title</label>
                            <input type="text" class="form-control department_title" name="department_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deparment Description</label>
                            <input type="text" class="form-control dept_desc" name="dept_desc" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deparment Code</label>
                            <input type="text" class="form-control dept_code" name="dept_code" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Button Text</label>
                            <input type="text" class="form-control button_text" name="button_text" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Department Image</label>
                            <input type="file" class="form-control" name="department_image" accept="image/*">
                        </div>
                        <button type="submit" name="update_program" class="btn btn-primary w-100">Update</button>
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
                            <th colspan="7" class="bg-light">
                                <div class="d-flex justify-content-between align-items-center p-2">
                                    <h5 class="mb-0">Departments</h5>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Add Department
                                    </button>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Department Title</th>
                            <th>Deparment Description</th>
                            <th>Deparment Code</th>
                            <th>Button text</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($programSqlResult)) { ?>
                            <tr>
                                <td class="program_id"><?php echo $row['id']; ?></td>
                                <td>
                                    <?php if(!empty($row['department_image'])): ?>
                                        <img src="<?php echo htmlspecialchars($row['department_image']); ?>" alt="Department Image" style="max-width: 100px;">
                                    <?php else: ?>
                                        No Image
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($row['department_title']); ?></td>
                                <td><?php echo htmlspecialchars($row['dept_desc']); ?></td>
                                <td><?php echo htmlspecialchars($row['dept_code']); ?></td>
                                <td><?php echo htmlspecialchars($row['button_text']); ?></td>
                                <td>
                                    <a class="btn btn-sm btn-warning mx-1 edit_program">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="delete_program.php?id=<?php echo $row['id']; ?>" 
                                       class="btn btn-sm btn-danger mx-1"
                                       onclick="return confirm('Are you sure you want to delete this program?');">
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script>
    // Add this to your existing JavaScript section
$(document).ready(function() {
    $('.edit_program').click(function(e) {
        e.preventDefault();
        var id = $(this).closest('tr').find('.program_id').text();
        
        $.ajax({
            method: "POST",
            url: "update_program.php",
            data: {
                'get_program': true,
                'program_id': id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('.program_id').val(data.id);
                $('.department_title').val(data.department_title);
                $('.dept_desc').val(data.dept_desc);
                $('.dept_code').val(data.dept_code);
                $('.button_text').val(data.button_text);
                $('#editProgramModal').modal('show');
            }
        });
    });

    // Preview image before upload
    $('input[type="file"]').change(function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').attr('src', e.target.result);
            $('#imagePreview').show();
        }
        reader.readAsDataURL(this.files[0]);
    });
});
   </script>
</body>
</html>