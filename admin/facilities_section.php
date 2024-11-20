<?php
// facilities_section.php

require_once('../config.php');
$facilitiesSql = "SELECT * FROM facilities_section";
$facilitiesSqlResult = $con->query($facilitiesSql);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['facility_form'])) {
    $facility_title = $_POST['facility_title'];
    $facility_desc = $_POST['facility_desc'];

    // Insert base data
    $stmt = $con->prepare("INSERT INTO facilities_section (facility_title, facility_desc) VALUES (?, ?)");
    $stmt->bind_param("ss", $facility_title, $facility_desc);

    if ($stmt->execute()) {
        $facility_id = $stmt->insert_id;
        
        // Handle image uploads
        for($i = 1; $i <= 5; $i++) {
            if(isset($_FILES['facility_image'.$i]) && $_FILES['facility_image'.$i]['error'] == 0) {
                $image = $_FILES['facility_image'.$i];
                $uploadDir = 'img/facilities/';
                $imageName = time() . '_' . $i . '_' . basename($image['name']);
                $targetPath = $uploadDir . $imageName;
                
                if(!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                if(move_uploaded_file($image['tmp_name'], $targetPath)) {
                    $imgField = 'facility_image'.$i;
                    $stmt = $con->prepare("UPDATE facilities_section SET $imgField = ? WHERE id = ?");
                    $stmt->bind_param("si", $targetPath, $facility_id);
                    $stmt->execute();
                }
            }
        }
        header("Location: facilities_section.php");
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

    <!-- Add Facility Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Facility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="facility_form">
                        <div class="mb-3">
                            <label class="form-label">Facility Title</label>
                            <input type="text" class="form-control" name="facility_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="facility_desc" required></textarea>
                        </div>
                        <?php for($i = 1; $i <= 5; $i++): ?>
                        <div class="mb-3">
                            <label class="form-label">Image <?php echo $i; ?></label>
                            <input type="file" class="form-control" name="facility_image<?php echo $i; ?>" accept="image/*">
                        </div>
                        <?php endfor; ?>
                        <button type="submit" class="btn btn-primary w-100">Add Facility</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Facility Modal -->
    <div class="modal fade" id="editFacilityModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Facility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="update_facility.php">
                        <input type="hidden" name="id" class="facility_id">
                        <div class="mb-3">
                            <label class="form-label">Facility Title</label>
                            <input type="text" class="form-control facility_title" name="facility_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control facility_desc" name="facility_desc" required></textarea>
                        </div>
                        <?php for($i = 1; $i <= 5; $i++): ?>
                        <div class="mb-3">
                            <label class="form-label">Image <?php echo $i; ?></label>
                            <input type="file" class="form-control" name="facility_image<?php echo $i; ?>" accept="img/*">
                            <div class="current-image<?php echo $i; ?>"></div>
                        </div>
                        <?php endfor; ?>
                        <button type="submit" name="update_facility" class="btn btn-primary w-100">Update Facility</button>
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
                            <th colspan="9" class="bg-light">
                                <div class="d-flex justify-content-between align-items-center p-2">
                                    <h5 class="mb-0">Facilities</h5>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Add Facility
                                    </button>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image 1</th>
                            <th>Image 2</th>
                            <th>Image 3</th>
                            <th>Image 4</th>
                            <th>Image 5</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($facilitiesSqlResult)) { ?>
                            <tr>
                                <td class="facility_id" data-label="ID"><?php echo $row['id']; ?></td>
                                <td data-label="Title"><?php echo htmlspecialchars($row['facility_title']); ?></td>
                                <td data-label="Description"><?php echo htmlspecialchars($row['facility_desc']); ?></td>
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                <td data-label="Image <?php echo $i; ?>">
                                    <?php if(!empty($row['facility_image'.$i])): ?>
                                        <img src="<?php echo htmlspecialchars($row['facility_image'.$i]); ?>" style="max-width: 50px;">
                                    <?php endif; ?>
                                </td>
                                <?php endfor; ?>
                                <td class="text-center" data-label="Actions">
                                    <a class="btn btn-sm btn-warning mx-1 edit_facility">
    <i class="bi bi-pencil-square"></i>
</a>
                                    <a href="delete_facility.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger mx-1" onclick="return confirm('Are you sure?');">
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

    <script>
$(document).ready(function() {
    $('.edit_facility').click(function(e) {
        e.preventDefault();
        
        var facility_id = $(this).closest('tr').find('.facility_id').text();
        
        $.ajax({
            method: "POST",
            url: "update_facility.php",
            data: {
                'get_facility': true,
                'facility_id': facility_id
            },
            dataType: 'json',
            success: function(response) {
                // Populate modal fields
                $('.facility_id').val(response.id);
                $('.facility_title').val(response.facility_title);
                $('.facility_desc').val(response.facility_desc);
                
                // Show current images
                for(var i = 1; i <= 5; i++) {
                    var imgField = 'facility_image' + i;
                    if(response[imgField]) {
                        $('.current-image' + i).html(
                            '<img src="' + response[imgField] + '" style="max-width: 100px; margin-top: 10px;">'
                        );
                    }
                }
                
                // Show modal
                $('#editFacilityModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                console.log('Response Text:', xhr.responseText);
            }
        });
    });
});
</script>

</body>
</html>