<?php
require_once('../config.php');
$aboutSql = "SELECT * FROM aboutus";
$aboutResult = $con->query($aboutSql); // Change this line

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['about_form'])) {
    $mission_title = $_POST['mission_title'];
    $mission_description = $_POST['mission_description'];
    $vision_title = $_POST['vision_title'];
    $vision_description = $_POST['vision_description'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $imageName = basename($image['name']);
        $imageTmpPath = $image['tmp_name'];
        $uploadDir = 'img/';

        $targetFilePath = $uploadDir . $imageName;
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($imageTmpPath, $targetFilePath)) {
        // Update the SQL query
    $stmt = $con->prepare("INSERT INTO aboutus (mission_title, mission_description, vision_title, vision_description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $mission_title, $mission_description, $vision_title, $vision_description);

            if ($stmt->execute()) {
                header("Refresh: 1; url=manage_aboutus.php");
            } 
        } 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/head.php'; ?>
    <title>Manage About Us</title>
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
<body>
    <?php include 'adminnav.php'; ?>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add About Us Section</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="about_form">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Choose Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="order" class="form-label">Display Order</label>
                        <input type="number" class="form-control" id="order" name="order" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
            </div>
        </div>
    </div>
<div class="main-container ">
    <div class="table-wrapper">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th colspan="6" class="bg-light">
                            <div class="d-flex justify-content-between align-items-center p-2">
                                <h5 class="card-title mb-0">Read About Us</h5>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Add Record
                                </button>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th class="px-2 py-2 text-center" scope="col"><strong>ID</strong></th>
                        <th class="px-2 py-2 text-center" scope="col"><strong>MISSION TITLE</strong></th>
                        <th class="px-2 py-2 text-center" scope="col"><strong>MISSION DESCRIPTION</strong></th>
                        <th class="px-2 py-2 text-center" scope="col"><strong>VISION TITLE</strong></th>
                        <th class="px-2 py-2 text-center" scope="col"><strong>VISION DESCRIPTION</strong></th>
                        <th class="px-2 py-2 text-center" scope="col"><strong>ACTION</strong></th>
                    </tr>
                </thead>
                <tbody>
                 <?php while($res = mysqli_fetch_assoc($aboutResult)) { ?>
                    <tr>
                        <td class="px-3 py-3 text-center about_id" data-label="ID"><?php echo $res['id']; ?></td>
                        <td class="px-3 py-3 text-center" data-label="MISSION TITLE"><?php echo htmlspecialchars($res['mission_title']); ?></td>
                        <td class="px-3 py-3 text-center" data-label="MISSION DESCRIPTION"><?php echo htmlspecialchars($res['mission_description']); ?></td>
                        <td class="px-3 py-3 text-center" data-label="VISION TITLE"><?php echo htmlspecialchars($res['vision_title']); ?></td>
                        <td class="px-3 py-3 text-center" data-label="VISION DESCRIPTION"><?php echo htmlspecialchars($res['vision_description']); ?></td>
                        <td class="px-3 py-3 text-center" data-label="ACTION">
                            <a class="btn btn-sm btn-warning mx-1 edit_about">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                            </a>
                            <a href="#" class="btn btn-sm btn-danger mx-1" onclick="return confirm('Are you sure you want to delete this item?');">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <!-- Add Modal -->
    <div class="modal fade" id="addAboutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add About Us Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addAboutForm" action="code.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Mission Title</label>
                            <input type="text" class="form-control" name="mission_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mission Description</label>
                            <textarea class="form-control" name="mission_description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vision Title</label>
                            <input type="text" class="form-control" name="vision_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vision Description</label>
                            <textarea class="form-control" name="vision_description" required></textarea>
                        </div>
                        <button type="submit" name="add_about" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editAboutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit About Us Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editAboutForm" action="code.php" method="POST">
                        <input type="hidden" name="edit_id" id="edit_about_id">
                        <div class="mb-3">
                            <label class="form-label">Mission Title</label>
                            <input type="text" class="form-control" name="mission_title" id="edit_mission_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mission Description</label>
                            <textarea class="form-control" name="mission_description" id="edit_mission_description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vision Title</label>
                            <input type="text" class="form-control" name="vision_title" id="edit_vision_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vision Description</label>
                            <textarea class="form-control" name="vision_description" id="edit_vision_description" required></textarea>
                        </div>
                        <button type="submit" name="update_about" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

   <script>
$(document).ready(function () {
    $('.edit_about').click(function (e) {
        e.preventDefault();

        var about_id = $(this).closest('tr').find('.about_id').text();
        console.log('About ID:', about_id); // Debug log

        $.ajax({
            method: "POST",
            url: "update_aboutus.php",
            data: {
                'edit_deets': true,
                'about_id': about_id,
            },
            dataType: 'json', // Specify expected data type
            success: function (response) {
                console.log('Response:', response); // Debug log

                // Populate modal fields
                $('.about_id').val(response[0].ID);
                $('.about_title').val(response[0].title);
                $('.about_desc').val(response[0].description);
                $('.about_content').val(response[0].content);
                $('.about_order').val(response[0].display_order);

                // Show modal
                $('#editAboutModal').modal('show');
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