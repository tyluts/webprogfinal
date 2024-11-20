<?php
require_once('../config.php');
$curriculumSql = "SELECT c.*, p.program_title 
                  FROM curriculum_images c 
                  JOIN department_programs p ON c.program_id = p.id";
$curriculumResult = $con->query($curriculumSql);

// Get programs for dropdown
$programsSql = "SELECT id, program_title FROM department_programs";
$programsResult = $con->query($programsSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/head.php'; ?>
    <title>Manage Curriculum Images</title>
     <style>
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

    <div class="main-container">
        <div class="table-wrapper">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th colspan="6" class="bg-light">
                                <div class="d-flex justify-content-between align-items-center p-2">
                                    <h5 class="card-title mb-0">Manage Curriculum Images</h5>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addImageModal">
                                        Add Image
                                    </button>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Program</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $curriculumResult->fetch_assoc()): ?>
                        <tr>
                            <td class="px-2 py-2" data-label="ID"><?php echo $row['id']; ?></td>
                            <td class="px-2 py-2" data-label="PROGRAM"><?php echo htmlspecialchars($row['program_title']); ?></td>
                            <td class="px-2 py-2" data-label="IMAGE">
                                <img src="<?php echo $row['image_path']; ?>" alt="Curriculum" style="max-width: 100px;">
                            </td>
                            <td class="px-2 py-2" data-label="TITLE"><?php echo htmlspecialchars($row['image_title']); ?></td>
                            
                            <td class="px-2 py-2" data-label="ACTION">
                                <button class="btn btn-warning btn-sm edit_image" data-id="<?php echo $row['id']; ?>">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <a href="delete_curriculum.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Image Modal -->
<!------curriculum add modal------->
<div class="modal fade" id="staticBackdropCurriculum" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropCurriculumLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropCurriculumLabel">Add Curriculum</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Choose Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>
                    <button type="submit" name="curriculum_add" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <!------curriculum edit modal------->
<div class="modal fade" id="staticBackdropCurriculumUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropCurriculumUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropCurriculumUpdateLabel">Edit Curriculum</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="update_curriculum.php">
                    <input type="hidden" name="id" class="curriculum_id" value="">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control curriculum_title" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control curriculum_desc" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Choose Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                        <img id="imagePreview" src="#" alt="Selected Image" style="display: none; width: 100%; margin-top: 10px;" />
                    </div>
                    <button type="submit" name="curriculum_update" class="btn btn-primary w-100">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<script>
    $(document).ready(function () {
        $('.edit_curriculum').click(function (e) {
            e.preventDefault();
            
            var curriculum_id = $(this).closest('tr').find('.curriculum_id').text();
            console.log(curriculum_id); 
            
            $.ajax({
                method: "POST",
                url: "update_curriculum.php",
                data: {
                    'edit_curriculum': true,
                    'curriculum_id': curriculum_id,
                },
                success: function (response) {
                    console.log(response); 
                    
                    $.each(response, function (key, value) {
                        $('.curriculum_id').val(value['ID']);
                        $('.curriculum_title').val(value['title']);
                        $('.curriculum_desc').val(value['description']);
                    });

                    $('#staticBackdropCurriculumUpdate').modal('show');
                }
            });
        });
    });
</script>