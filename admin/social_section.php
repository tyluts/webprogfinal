<?php
require_once('../config.php');
$socialSql = "SELECT * FROM social_section";
$socialSqlResult = $con->query($socialSql);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['social_form'])) {
    $title = $_POST['social_title'];
    $description = $_POST['social_desc'];
    $icon = $_POST['social_icon'];
    
    // Handle image upload
    $image = '';
    if(isset($_FILES['social_image']) && $_FILES['social_image']['error'] == 0) {
        $target_dir = "uploads/social/";
        if(!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $image = $target_dir . basename($_FILES["social_image"]["name"]);
        move_uploaded_file($_FILES["social_image"]["tmp_name"], $image);
    }

    $stmt = $con->prepare("INSERT INTO social_section (social_title, social_desc, social_icon, social_image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $icon, $image);

    if ($stmt->execute()) {
        header("Location: social_section.php?success=1");
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

    <!-- Add Social Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Social Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="social_form">
    <div class="mb-3">
        <label class="form-label">Social Title</label>
        <input type="text" class="form-control" name="social_title" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="social_desc" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Icon Class</label>
        <input type="text" class="form-control" name="social_icon" required placeholder="fab fa-facebook">
    </div>
    <div class="mb-3">
        <label class="form-label">Social Image</label>
        <input type="file" class="form-control" name="social_image" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary w-100">Add Social Media</button>
</form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Social Modal -->
    <div class="modal fade" id="editSocialModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Social Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="update_social.php" enctype="multipart/form-data">
    <input type="hidden" name="id" class="social_id">
    <div class="mb-3">
        <label class="form-label">Social Title</label>
        <input type="text" class="form-control social_title" name="social_title" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control social_desc" name="social_desc" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Icon Class</label>
        <input type="text" class="form-control social_icon" name="social_icon" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Social Image</label>
        <input type="file" class="form-control" name="social_image" accept="image/*">
        <div id="currentImage" class="mt-2"></div>
    </div>
    <button type="submit" name="update_social" class="btn btn-primary w-100">Update</button>
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
                            <th colspan="6" class="bg-light">
                                <div class="d-flex justify-content-between align-items-center p-2">
                                    <h5 class="mb-0">Social Media Links</h5>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Add Social Media
                                    </button>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Icon</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($socialSqlResult)) { ?>
                            <tr>
                                <td class="social_id"><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['social_title']); ?></td>
                                <td><?php echo htmlspecialchars($row['social_desc']); ?></td>
                                <td><i class="<?php echo htmlspecialchars($row['social_icon']); ?>"></i></td>
                                <td>
    <?php if(!empty($row['social_image'])): ?>
        <img src="<?php echo htmlspecialchars($row['social_image']); ?>" alt="Social Image" style="max-width: 100px;">
    <?php endif; ?>
</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-warning mx-1 edit_social">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="delete_social.php?id=<?php echo $row['id']; ?>" 
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
            $('.edit_social').click(function(e) {
                e.preventDefault();
                var id = $(this).closest('tr').find('.social_id').text();
                
                $.ajax({
                    method: "POST",
                    url: "update_social.php",
                    data: {
                        'get_social': true,
                        'social_id': id
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        $('.social_id').val(data.id);
                        $('.social_title').val(data.social_title);
                        $('.social_desc').val(data.social_desc);
                        $('.social_icon').val(data.social_icon);
                        $('#editSocialModal').modal('show');
                    }
                });
            });
        });
    </script>
</body>
</html>