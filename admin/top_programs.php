<?php
require_once('../config.php');

// Fetch data from the top_programs table
$programSql = "SELECT * FROM top_programs";
$programSqlResult = $con->query($programSql);

// Handling form submission to add a new program
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['program_form'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $dept_code = $_POST['dept_code'];

    // Insert the new program into the database
    $stmt = $con->prepare("INSERT INTO top_programs (title, description, dept_code) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $dept_code);

    if ($stmt->execute()) {
        header("Refresh: 1; url=top_programs.php"); // Refresh the page to show the updated list
    }
}

// Update program
if (isset($_POST['update_program'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $dept_code = $_POST['dept_code'];

    $stmt = $con->prepare("UPDATE top_programs SET title=?, description=?, dept_code=? WHERE id=?");
    $stmt->bind_param("sssi", $title, $description, $dept_code, $id);

    if ($stmt->execute()) {
        header("Location: top_programs.php?update=success");
    } else {
        echo "Error: " . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <title>Top Programs</title>
    
    <style>
        .modal-backdrop {
            display: none !important;
        }

        .table-wrapper {
            background: white;
            border-radius: 0.25rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .text-wrap {
            word-break: break-word;
            white-space: normal;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar (Optional) -->
    <?php include 'adminnav.php'; ?>

    <!-- Add Program Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Program</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="program_form">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Department Code</label>
                            <input type="text" class="form-control" name="dept_code" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add Program</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateProgramModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Program</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="update_program">
                        <input type="hidden" name="id" id="program_id">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control " name="title" id="update_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" id="update_description" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Department Code</label>
                            <input type="text" class="form-control" name="dept_code" id="update_dept_code" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Program</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="table-wrapper">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th colspan="5" class="bg-light">
                                <div class="d-flex justify-content-between align-items-center p-2">
                                    <h5 class="mb-0">Top Programs</h5>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Add Program
                                    </button>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Department Code</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($programSqlResult)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                <td><?php echo htmlspecialchars($row['dept_code']); ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#updateProgramModal" onclick="populateUpdateForm(<?php echo $row['id']; ?>)">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#deleteProgramModal" onclick="setDeleteId(<?php echo $row['id']; ?>)">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteProgramModal" tabindex="-1" aria-labelledby="deleteProgramModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProgramModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this program?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="deleteProgram()">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript to populate the update form -->
    <script>
        function populateUpdateForm(id) {
            // Get the program details using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "get_top_program_details.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var program = JSON.parse(xhr.responseText);
                    if (program) {
                        document.getElementById('program_id').value = program.id;
                        document.getElementById('update_title').value = program.title;
                        document.getElementById('update_description').value = program.description;
                        document.getElementById('update_dept_code').value = program.dept_code;
                    }
                }
            };
            xhr.send("get_program=true&program_id=" + id);
        }
    </script>

    <script>
        
        function softDeleteProgram() {
            if (programIdToDelete !== null) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "delete_program.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = xhr.responseText;
                        if (response === "success") {
                            $('#deleteProgramModal').modal('hide');
                            alert("Program marked as deleted.");
                            window.location.reload(); 
                        } else {
                            alert("Error marking program as deleted.");
                        }
                    }
                };
                xhr.send("delete_program=true&program_id=" + programIdToDelete);
            }
        }

    </script>
</body>
</html>
