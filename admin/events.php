<?php
require_once('../config.php');
$eventsSql = "SELECT * FROM events";
$eventsSqlResult = $con->query($eventsSql);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['event_form'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $datetime = $_POST['datetime'];
    $loc = $_POST['loc'];  // New location field

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
            // Insert into database, including the location
            $stmt = $con->prepare("INSERT INTO events (img, title, description, date, loc) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $targetFilePath, $title, $description, $datetime, $loc);

            if ($stmt->execute()) {
                header("Refresh: 1; url=events.php");
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
</head>
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

<body class="black">
    <?php include 'adminnav.php'; ?>
    <!---------insert modal------>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Event</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="event_form">
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
                    <div class="mb-3">
                        <label for="datetime" class="form-label">Date and Time</label>
                        <input type="datetime-local" class="form-control" id="datetime" name="datetime" required>
                        
                    </div>
                    <div class="mb-3">
                        <label for="loc" class="form-label">Location</label>
                        <input type="text" class="form-control" id="loc" name="loc" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
    
            </div>
        </div>
    </div>
    <!---------insert modal------>


    <!---------edit modal------>
<!-- Events Modal -->
<div class="modal fade" id="staticBackdropEventsUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropEventsUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropEventsUpdateLabel">Edit Event</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="update_events.php">
                    <!-- Hidden ID Field -->
                    <input type="hidden" name="id" class="event_id" value="">

                    <!-- Title Input -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control event_title" id="title" name="title" required>
                    </div>

                    <!-- Description Input -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control event_desc" id="description" name="description" rows="3" required></textarea>
                    </div>

                    <!-- Date & Time Input -->
                    <div class="mb-3">
                        <label for="datetime" class="form-label">Date & Time</label>
                        <input type="datetime-local" class="form-control event_datetime" id="datetime" name="datetime" required>
                    </div>

                    <!-- Location Input -->
                    <div class="mb-3">
                        <label for="loc" class="form-label">Location</label>
                        <input type="text" class="form-control event_loc" id="loc" name="loc" required>
                    </div>

                    <!-- Image Input -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Choose Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                        <img id="imagePreview" src="#" alt="Selected Image" style="display: none; width: 100%; margin-top: 10px;" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" name="update_event" class="btn btn-primary w-100">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <!---------edit modal------>
     
<div class="main-container ">
    <div class="table-wrapper">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th colspan="7" class="bg-light">
                            <div class="d-flex justify-content-between align-items-center p-2">
                                <h5 class="card-title mb-0">Read Events</h5>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Add Record
                                </button>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th class="px-2 py-2 text-center" scope="col"><strong>ID</strong></th>
                        <th class="px-2 py-2 text-center" scope="col"><strong>IMAGE</strong></th>
                        <th class="px-2 py-2 text-center" scope="col"><strong>TITLE</strong></th>
                        <th class="px-2 py-2 text-center" scope="col"><strong>DESCRIPTION</strong></th>
                        <th class="px-2 py-2 text-center" scope="col"><strong>DATE</strong></th>
                        <th class="px-2 py-2 text-center" scope="col"><strong>LOCATION</strong></th>
                        <th class="px-2 py-2 text-center" scope="col"><strong>ACTION</strong></th>
                    </tr>
                </thead>
                <tbody>
                 <?php while($res = mysqli_fetch_assoc($eventsSqlResult)) { ?>
    <tr>
        <td class="px-3 py-3 text-center event_id" data-label="ID"><?php echo $res['ID']; ?></td>
        <td class="px-3 py-3 text-center" data-label="IMAGE">
            <?php if (!empty($res['img'])): ?>
                <img src="<?php echo htmlspecialchars($res['img']); ?>" alt="Event Photo" style="max-width: 100px; max-height: 100px;">
            <?php else: ?>
                No Photo
            <?php endif; ?>
        </td>
        <td class="px-3 py-3 text-center" data-label="TITLE"><?php echo htmlspecialchars($res['title']); ?></td>
        <td class="px-3 py-3 text-center" data-label="DESCRIPTION"><?php echo htmlspecialchars($res['description']); ?></td>
        
        <td class="px-3 py-3 text-center" data-label="DATE">
            <?php echo $res['date'] !== '0000-00-00' ? htmlspecialchars($res['date']) : 'N/A'; ?>
        </td>
        <td class="px-3 py-3 text-center" data-label="LOCATION"><?php echo htmlspecialchars($res['loc']); ?></td>
        <td class="px-3 py-3 text-center " data-label="ACTION">
            <a class="btn btn-sm btn-warning mx-1 edit_event">
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
<!-- jQuery (required for Bootstrap's JavaScript components) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>

<!-- Bootstrap JavaScript Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    
</body>
</html>
<script>
$(document).ready(function () {
    $('.edit_event').click(function (e) {
        e.preventDefault();

        var event_id = $(this).closest('tr').find('.event_id').text();
        console.log('Event ID:', event_id); // Debug log

        $.ajax({
            method: "POST",
            url: "update_events.php",
            data: {
                'edit_deets': true,
                'event_id': event_id,
            },
            dataType: 'json', // Specify expected data type
            success: function (response) {
                console.log('Response:', response); // Debug log

                // Populate modal fields
                $('.event_id').val(response[0].ID);
                $('.event_title').val(response[0].title);
                $('.event_desc').val(response[0].description);
                $('.event_datetime').val(response[0].date);
                $('.event_loc').val(response[0].loc);

                // Show modal
                $('#staticBackdropEventsUpdate').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                console.log('Response Text:', xhr.responseText);
            }
        });
    });
});
</script>