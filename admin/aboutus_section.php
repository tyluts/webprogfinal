<?php
require_once('../config.php');
$aboutusSql = "SELECT * FROM aboutus_section";
$aboutusSqlResult = $con->query($aboutusSql);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['aboutus_form'])) {
    $mission_title = $_POST['mission_title'];
    $mission_desc = $_POST['mission_desc'];
    $vision_title = $_POST['vision_title'];
    $vision_desc = $_POST['vision_desc'];

    // Handle mission image
    if (isset($_FILES['mission_image']) && $_FILES['mission_image']['error'] == 0) {
        $image = $_FILES['mission_image'];
        $imageName = basename($image['name']);
        $imageTmpPath = $image['tmp_name'];
        $uploadDir = 'uploads/';

        $mission_image = $uploadDir . time() . '_' . $imageName;
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($imageTmpPath, $mission_image)) {
            // Handle vision image
            if (isset($_FILES['vision_image']) && $_FILES['vision_image']['error'] == 0) {
                $vimage = $_FILES['vision_image'];
                $vimageName = basename($vimage['name']);
                $vimageTmpPath = $vimage['tmp_name'];
                
                $vision_image = $uploadDir . time() . '_' . $vimageName;
                move_uploaded_file($vimageTmpPath, $vision_image);

                // Insert into database
                $stmt = $con->prepare("INSERT INTO aboutus_section (mission_title, mission_desc, mission_image, vision_title, vision_desc, vision_image) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $mission_title, $mission_desc, $mission_image, $vision_title, $vision_desc, $vision_image);

                if ($stmt->execute()) {
                    header("Refresh: 1; url=aboutus_section.php");
                }
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

    <!-- Add About Us Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add About Us Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="aboutus_form">
                        <div class="mb-3">
                            <label class="form-label">Mission Title</label>
                            <input type="text" class="form-control" name="mission_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mission Description</label>
                            <textarea class="form-control" name="mission_desc" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mission Image</label>
                            <input type="file" class="form-control" name="mission_image" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vision Title</label>
                            <input type="text" class="form-control" name="vision_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vision Description</label>
                            <textarea class="form-control" name="vision_desc" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vision Image</label>
                            <input type="file" class="form-control" name="vision_image" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add About Us Section</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit About Us Modal -->
    <div class="modal fade" id="editAboutUsModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit About Us Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="update_aboutus.php">
                        <input type="hidden" name="id" class="aboutus_id">
                        <div class="mb-3">
                            <label class="form-label">Mission Title</label>
                            <input type="text" class="form-control aboutus_mission_title" name="mission_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mission Description</label>
                            <textarea class="form-control aboutus_mission_desc" name="mission_desc" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mission Image</label>
                            <input type="file" class="form-control" name="mission_image" accept="image/*">
                            <img class="aboutus_mission_image_preview mt-2 w-100" style="display: none;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vision Title</label>
                            <input type="text" class="form-control aboutus_vision_title" name="vision_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vision Description</label>
                            <textarea class="form-control aboutus_vision_desc" name="vision_desc" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vision Image</label>
                            <input type="file" class="form-control" name="vision_image" accept="image/*">
                            <img class="aboutus_vision_image_preview mt-2 w-100" style="display: none;">
                        </div>
                        <button type="submit" name="update_aboutus" class="btn btn-primary w-100">Update About Us Section</button>
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
                                    <h5 class="mb-0">About Us Sections</h5>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Add About Us Section
                                    </button>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Mission Title</th>
                            <th>Mission Description</th>
                            <th>Mission Image</th>
                            <th>Vision Title</th>
                            <th>Vision Description</th>
                            <th>Vision Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($aboutusSqlResult)) { ?>
                            <tr>
                                <td class="aboutus_id"><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['mission_title']); ?></td>
                                <td><?php echo htmlspecialchars($row['mission_desc']); ?></td>
                                <td>
                                    <?php if(!empty($row['mission_image'])): ?>
                                        <img src="<?php echo htmlspecialchars($row['mission_image']); ?>" alt="Mission Image" style="max-width: 100px;">
                                    <?php else: ?>
                                        No Image
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($row['vision_title']); ?></td>
                                <td><?php echo htmlspecialchars($row['vision_desc']); ?></td>
                                <td>
                                    <?php if(!empty($row['vision_image'])): ?>
                                        <img src="<?php echo htmlspecialchars($row['vision_image']); ?>" alt="Vision Image" style="max-width: 100px;">
                                    <?php else: ?>
                                        No Image
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-warning mx-1 edit-aboutus" data-id="<?php echo $row['id']; ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="delete_aboutus.php?id=<?php echo $row['id']; ?>" 
                                       class="btn btn-sm btn-danger mx-1"
                                       onclick="return confirm('Are you sure you want to delete this section?');">
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.edit-aboutus').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                
                $.ajax({
                    method: "POST",
                    url: "update_aboutus.php",
                    data: {
                        'get_aboutus': true,
                        'aboutus_id': id
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        $('.aboutus_id').val(data.id);
                        $('.aboutus_mission_title').val(data.mission_title);
                        $('.aboutus_mission_desc').val(data.mission_desc);
                        $('.aboutus_vision_title').val(data.vision_title);
                        $('.aboutus_vision_desc').val(data.vision_desc);
                        
                        if(data.mission_image) {
                            $('.aboutus_mission_image_preview').attr('src', data.mission_image).show();
                        }
                        if(data.vision_image) {
                            $('.aboutus_vision_image_preview').attr('src', data.vision_image).show();
                        }
                        
                        $('#editAboutUsModal').modal('show');
                    }
                });
            });
        });
    </script>
</body>
</html>