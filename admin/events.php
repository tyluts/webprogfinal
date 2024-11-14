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
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Event uploaded successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload(); // Refresh the page
                        });
                      </script>";
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Database Error',
                            text: '" . $stmt->error . "'
                        });
                      </script>";
            }
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Upload Error',
                        text: 'Failed to move uploaded file.'
                    });
                  </script>";
        }
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'File Error',
                    text: 'Error: " . $_FILES['image']['error'] . "'
                });
              </script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS (single version) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome & Boxicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Custom Stylesheets (remove duplicates) -->
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

</style>
<body class="black">
    <?php include 'adminnav.php'; ?>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
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

     
<div class="container-fluid mt-5 d-flex align-items-center justify-content-center" style="height: calc(100vh - 56px);">
    <div class="card col-12 col-md-8 col-lg-6">
        <div class="card-body">
            <h5 class="card-title">
                Read Events
            </h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add Record
            </button>

            <!-- Full-width responsive table -->
            <table class="table-responsive table table-bordered table-striped table-hover mt-2">
                <thead>
                    <tr>
                        <th class="px-3 py-3 text-center" scope="col"><strong>ID</strong></th>
                        <th class="px-3 py-3 text-center" scope="col"><strong>IMAGE</strong></th>
                        <th class="px-3 py-3 text-center" scope="col"><strong>TITLE</strong></th>
                        <th class="px-3 py-3 text-center" scope="col"><strong>DESCRIPTION</strong></th>
                        <th class="px-3 py-3 text-center" scope="col"><strong>DATE</strong></th>
                        <th class="px-3 py-3 text-center" scope="col"><strong>LOCATION</strong></th>
                        <th class="px-3 py-3 text-center" scope="col"><strong>ACTION</strong></th>
                    </tr>
                </thead>
                <tbody>
                <?php while($res = mysqli_fetch_assoc($eventsSqlResult)) { ?>
                    <tr>
                        <td class="px-3 py-3 text-center"><?php echo $res['ID'] ?></td>
                        <td class="px-3 py-3 text-center"><img src="<?php echo $res['img'] ?>" alt="Event Image" width="50"></td>
                        <td class="px-3 py-3 text-center"><?php echo $res['title'] ?></td>
                        <td class="px-3 py-3 text-center"><?php echo $res['description'] ?></td>
                        <td class="px-3 py-3 text-center"><?php echo $res['date'] ?></td>
                        <td class="px-3 py-3 text-center"><?php echo $res['loc'] ?></td>
                        <td class="px-3 py-3 text-center">
                            <a href="edit.php?id=<?php echo $res['ID']; ?>" class="btn btn-sm btn-warning mx-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                            </a>
                            <a href="delete.php?id=<?php echo $res['ID']; ?>" class="btn btn-sm btn-danger mx-1" onclick="return confirm('Are you sure you want to delete this item?');">
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




    
</body>
</html>