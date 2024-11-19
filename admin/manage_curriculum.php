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

    .table-responsive thead {
        display: none;
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
                            <th>Created At</th>
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
                            <td class="px-2 py-2" data-label="CREATED AT"><?php echo $row['created_at']; ?></td>
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
    <div class="modal fade" id="addImageModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Curriculum Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add_curriculum">
                        <div class="mb-3">
                            <label>Program</label>
                            <select name="program_id" class="form-control" required>
                                <?php while($program = $programsResult->fetch_assoc()): ?>
                                    <option value="<?php echo $program['id']; ?>">
                                        <?php echo htmlspecialchars($program['program_title']); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control" required accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label>Image Title</label>
                            <input type="text" name="image_title" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>