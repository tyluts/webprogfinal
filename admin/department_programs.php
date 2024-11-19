<?php
require_once('../config.php');
$programsSql = "SELECT * FROM department_programs";
$programsResult = $con->query($programsSql);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['program_form'])) {
    $program_title = $_POST['program_title'];
    $program_description = $_POST['program_description'];
    $curriculum_title = $_POST['curriculum_title'];
    $curriculum_description = $_POST['curriculum_description'];
    $social_title = $_POST['social_title'];
    $social_description = $_POST['social_description'];
    $social_icon = $_POST['social_icon'];

    if (isset($_FILES['curriculum_image']) && $_FILES['curriculum_image']['error'] == 0) {
        $image = $_FILES['curriculum_image'];
        $imageName = basename($image['name']);
        $imageTmpPath = $image['tmp_name'];
        $uploadDir = 'img/curriculum/';

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $targetFilePath = $uploadDir . $imageName;
        if (move_uploaded_file($imageTmpPath, $targetFilePath)) {
            $stmt = $con->prepare("INSERT INTO department_programs (program_title, program_description, curriculum_title, curriculum_image, curriculum_description, social_title, social_description, social_icon) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $program_title, $program_description, $curriculum_title, $targetFilePath, $curriculum_description, $social_title, $social_description, $social_icon);

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
    <?php include '../include/head.php'; ?>
    <link rel="stylesheet" href="../css/admincss/adminnav.css">
    <title>Manage Department Programs</title>
</head>
<body class="black">
    <?php include 'adminnav.php'; ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Department Programs
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#programModal">
                                Add Program
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Program Title</th>
                                    <th>Description</th>
                                    <th>Curriculum</th>
                                    <th>Social Media</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $programsResult->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['program_title']); ?></td>
                                        <td><?php echo substr(htmlspecialchars($row['program_description']), 0, 100) . '...'; ?></td>
                                        <td>
                                            <img src="<?php echo htmlspecialchars($row['curriculum_image']); ?>" 
                                                 alt="Curriculum" width="50" height="50">
                                            <?php echo htmlspecialchars($row['curriculum_title']); ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['social_title']); ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm edit-btn" 
                                                    data-id="<?php echo $row['id']; ?>">Edit</button>
                                            <button class="btn btn-danger btn-sm delete-btn" 
                                                    data-id="<?php echo $row['id']; ?>">Delete</button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Program Modal -->
    <div class="modal fade" id="programModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Program</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="program_form" value="1">
                        
                        <div class="mb-3">
                            <label>Program Title</label>
                            <input type="text" name="program_title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Program Description</label>
                            <textarea name="program_description" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Curriculum Title</label>
                            <input type="text" name="curriculum_title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Curriculum Image</label>
                            <input type="file" name="curriculum_image" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Curriculum Description</label>
                            <textarea name="curriculum_description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Social Title</label>
                            <input type="text" name="social_title" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Social Description</label>
                            <textarea name="social_description" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Social Icon</label>
                            <input type="text" name="social_icon" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Save Program</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>