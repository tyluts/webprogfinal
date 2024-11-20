<?php
require_once('../config.php');
$programsSql = "SELECT * FROM department_programs";
$programsResult = $con->query($programsSql);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['program_form'])) {
    $program_title = $_POST['program_title'];
    $program_description = $_POST['program_description'];
    $curriculum_title = $_POST['curriculum_title'];

    if (isset($_FILES['program_image']) && $_FILES['program_image']['error'] == 0) {
        $image = $_FILES['program_image'];
        $imageName = basename($image['name']);
        $imageTmpPath = $image['tmp_name'];
        $uploadDir = 'uploads/programs/';

        $targetFilePath = $uploadDir . $imageName;
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($imageTmpPath, $targetFilePath)) {
            // Insert into database
            $stmt = $con->prepare("INSERT INTO department_programs (program_title, program_description, curriculum_title, program_image) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $program_title, $program_description, $curriculum_title, $targetFilePath);

            if ($stmt->execute()) {
                header("Refresh: 1; url=manage_programs.php");
            } 
        } 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/head.php'; ?>
    <title>Manage Programs</title>
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
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Program</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="program_form">
                    <div class="mb-3">
                        <label for="program_title" class="form-label">Program Title</label>
                        <input type="text" class="form-control" id="program_title" name="program_title" required>
                    </div>
                    <div class="mb-3">
                        <label for="program_description" class="form-label">Program Description</label>
                        <textarea class="form-control" id="program_description" name="program_description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="curriculum_title" class="form-label">Curriculum Title</label>
                        <input type="text" class="form-control" id="curriculum_title" name="curriculum_title" required>
                    </div>
                    <div class="mb-3">
                        <label for="program_image" class="form-label">Choose Image</label>
                        <input type="file" class="form-control" id="program_image" name="program_image" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
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
            <h5 class="card-title mb-0">Manage Programs</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add Program
            </button>
        </div>
    </th>
</tr>
                        <tr>
                            <th class="px-2 py-2 text-center" scope="col"><strong>ID</strong></th>
                            <th class="px-2 py-2 text-center" scope="col"><strong>PROGRAM TITLE</strong></th>
                            <th class="px-2 py-2 text-center" scope="col"><strong>DESCRIPTION</strong></th>
                            <th class="px-2 py-2 text-center" scope="col"><strong>CURRICULUM TITLE</strong></th>
                            <th class="px-2 py-2 text-center" scope="col"><strong>ACTION</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $programsResult->fetch_assoc()): ?>
                            <tr>
                                <td class="px-2 py-2" data-label="ID"><?php echo $row['id'] ?></td>
                                <td class="px-2 py-2" data-label="Program Title">
                                    <?php echo htmlspecialchars($row['program_title']); ?>
                                </td>
                                <td class="px-2 py-2" data-label="Description">
                                    <div class="text-wrap"><?php echo htmlspecialchars($row['program_description']); ?></div>
                                </td>
                                <td class="px-2 py-2" data-label="Curriculum Title">
                                    <?php echo htmlspecialchars($row['curriculum_title']); ?>
                                </td>
                                <td class="px-2 py-2" data-label="Actions">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-warning edit_program">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                            </svg>
                                        </a>
                                        <a href="delete_program.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger mx-1" onclick="return confirm('Are you sure you want to delete this item?');">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all modals
    var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
    
    // Optional: Add trigger for modal
    document.querySelector('[data-bs-toggle="modal"]').addEventListener('click', function() {
        myModal.show();
    });
});
</script>
</body>
</html>