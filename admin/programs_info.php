<?php
require_once('../config.php');
$programSql = "SELECT * FROM program_info";
$programSqlResult = $con->query($programSql);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['program_form'])) {
    $program_title = $_POST['program_title'];
    $program_desc = $_POST['program_desc'];
    $curriculum_title = $_POST['curriculum_title'];
    $curriculum_image_title = $_POST['curriculum_image_title'];

    if (isset($_FILES['curriculum_image']) && $_FILES['curriculum_image']['error'] == 0) {
        $image = $_FILES['curriculum_image'];
        $imageName = basename($image['name']);
        $imageTmpPath = $image['tmp_name'];
        $uploadDir = 'img/curriculum/';

        $targetFilePath = $uploadDir . $imageName;
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($imageTmpPath, $targetFilePath)) {
            $stmt = $con->prepare("INSERT INTO program_info (program_title, program_desc, curriculum_title, curriculum_image_title, curriculum_image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $program_title, $program_desc, $curriculum_title, $curriculum_image_title, $targetFilePath);

            if ($stmt->execute()) {
                header("Refresh: 1; url=programs_info.php");
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
                            <label class="form-label">Curriculum Title</label>
                            <input type="text" class="form-control" name="curriculum_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Curriculum Image Title</label>
                            <input type="text" class="form-control" name="curriculum_image_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Curriculum Image</label>
                            <input type="file" class="form-control" name="curriculum_image" accept="image/*" required>
                        </div>
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
                        <div class="mb-3">
                            <label class="form-label">Curriculum Title</label>
                            <input type="text" class="form-control curriculum_title" name="curriculum_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Curriculum Image Title</label>
                            <input type="text" class="form-control curriculum_image_title" name="curriculum_image_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Curriculum Image</label>
                            <input type="file" class="form-control" name="curriculum_image" accept="image/*">
                            <img id="imagePreview" src="#" alt="Current Image" style="max-width: 100%; margin-top: 10px; display: none;">
                        </div>
                        <button type="submit" name="update_program" class="btn btn-primary w-100">Update Program</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="table-wrapper">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th colspan="7" class="bg-light">
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
                            <th>Curriculum Title</th>
                            <th>Image Title</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($programSqlResult)) { ?>
                            <tr>
                                <td class="program_id"  data-label="ID"><?php echo $row['id']; ?></td>
                                <td  data-label="Program Title"><?php echo htmlspecialchars($row['program_title']); ?></td>
                                <td  data-label="Description"><?php echo htmlspecialchars($row['program_desc']); ?></td>
                                <td  data-label="Curriculum Title"><?php echo htmlspecialchars($row['curriculum_title']); ?></td>
                                <td  data-label="Image Title"><?php echo htmlspecialchars($row['curriculum_image_title']); ?></td>
                                <td  data-label="Actions">
                                    <?php if (!empty($row['curriculum_image'])): ?>
                                        <img src="<?php echo htmlspecialchars($row['curriculum_image']); ?>" alt="Curriculum" style="max-width: 100px;">
                                    <?php else: ?>
                                        No Image
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-warning mx-1 edit_program">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="delete_program_info.php?id=<?php echo $row['id']; ?>" 
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
                    $('.curriculum_title').val(data.curriculum_title);
                    $('.curriculum_image_title').val(data.curriculum_image_title);
                    if(data.curriculum_image) {
                        $('#imagePreview').attr('src', data.curriculum_image).show();
                    }
                    $('#editProgramModal').modal('show');
                }
            });
        });
    });
    </script>
</body>
</html>