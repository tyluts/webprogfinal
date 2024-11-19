<?php
require_once('../config.php');
$socialSql = "SELECT s.*, p.program_title 
              FROM program_social s 
              JOIN department_programs p ON s.program_id = p.id";
$socialResult = $con->query($socialSql);

// Get programs for dropdown
$programsSql = "SELECT id, program_title FROM department_programs";
$programsResult = $con->query($programsSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/head.php'; ?>
    <title>Manage Social Media</title>
        <style>
 :root {
    --sidebar-width: 250px;
}

.main-container {
    margin-left: var(--sidebar-width);
    width: calc(100% - var(--sidebar-width));
    padding: 1.5rem;
    overflow-x: auto;
    margin-top: 60px;
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
                                    <h5 class="card-title mb-0">Manage Social Media</h5>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSocialModal">
                                        Add Social Media
                                    </button>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Program</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Icon</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $socialResult->fetch_assoc()): ?>
                            <tr>
                                <td class="px-2 py-2" data-label="ID"><?php echo $row['id']; ?></td>
                                <td class="px-2 py-2" data-label="PROGRAM"><?php echo htmlspecialchars($row['program_title']); ?></td>
                                <td class="px-2 py-2" data-label="TITLE"><?php echo htmlspecialchars($row['social_title']); ?></td>
                                <td class="px-2 py-2" data-label="DESCRIPTION"><?php echo htmlspecialchars($row['social_description']); ?></td>
                                <td class="px-2 py-2" data-label="ICON"><i class="<?php echo htmlspecialchars($row['social_icon']); ?>"></i></td>
                                <td class="px-2 py-2" data-label="ACTION">
                                    <button class="btn btn-warning btn-sm edit_social" data-id="<?php echo $row['id']; ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <a href="delete_social.php?id=<?php echo $row['id']; ?>" 
                                       class="btn btn-danger btn-sm"
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

    <!-- Add Social Modal -->
    <div class="modal fade" id="addSocialModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Social Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="code.php" method="POST">
                        <input type="hidden" name="action" value="add_social">
                        <div class="mb-3">
                            <label>Program</label>
                            <select name="program_id" class="form-control" required>
                                <?php 
                                mysqli_data_seek($programsResult, 0);
                                while($program = $programsResult->fetch_assoc()): 
                                ?>
                                    <option value="<?php echo $program['id']; ?>">
                                        <?php echo htmlspecialchars($program['program_title']); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Social Title</label>
                            <input type="text" name="social_title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="social_description" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Icon Class</label>
                            <input type="text" name="social_icon" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
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
                    <form action="code.php" method="POST">
                        <input type="hidden" name="action" value="edit_social">
                        <input type="hidden" name="social_id" id="edit_social_id">
                        <div class="mb-3">
                            <label>Program</label>
                            <select name="program_id" id="edit_program_id" class="form-control" required>
                                <?php 
                                mysqli_data_seek($programsResult, 0);
                                while($program = $programsResult->fetch_assoc()): 
                                ?>
                                    <option value="<?php echo $program['id']; ?>">
                                        <?php echo htmlspecialchars($program['program_title']); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Social Title</label>
                            <input type="text" name="social_title" id="edit_social_title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="social_description" id="edit_social_description" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Icon Class</label>
                            <input type="text" name="social_icon" id="edit_social_icon" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('.edit_social').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: 'code.php',
                method: 'POST',
                data: {
                    'get_social': true,
                    'social_id': id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    $('#edit_social_id').val(data.id);
                    $('#edit_program_id').val(data.program_id);
                    $('#edit_social_title').val(data.social_title);
                    $('#edit_social_description').val(data.social_description);
                    $('#edit_social_icon').val(data.social_icon);
                    $('#editSocialModal').modal('show');
                }
            });
        });
    });
    </script>

</body>
</html>