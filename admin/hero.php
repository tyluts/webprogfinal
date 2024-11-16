<?php
    require_once('../config.php');

    $carousel_sql = "SELECT * FROM images";
    $carousel_result = $con->query($carousel_sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['image_form'])) {
    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $imageName = basename($image['name']); // Get image name
        $imageTmpPath = $image['tmp_name'];    // Get temporary image path
        $uploadDir = 'img/';                    // Directory where images will be uploaded

        // Ensure the upload directory exists
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);  // Create directory if not exists
        }

        // Set the target file path and normalize the file path
        $targetFilePath = $uploadDir . $imageName;
        $targetFilePath = str_replace('\\', '/', $targetFilePath); // Ensure forward slashes

        // Move the uploaded image to the target directory
        if (move_uploaded_file($imageTmpPath, $targetFilePath)) {
            // Prepare SQL query to insert the image path into the database
            $stmt = $con->prepare("INSERT INTO images image_path VALUES (?)");
            $stmt->bind_param("s", $targetFilePath);  // Bind the image path as a string

            // Execute the query
            if ($stmt->execute()) {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Image uploaded successfully!',
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
                            text: 'Error: " . $stmt->error . "'
                        });
                      </script>";
            }
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Upload Error',
                        text: 'Failed to move uploaded file. Please try again.'
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
    <?php include '../include/head.php'; ?>
    <link rel="stylesheet" href="../css/admincss/adminnav.css">
    <title>Home</title>
</head>
<body class="black">
    <?php include 'adminnav.php'; ?>

        <!-- Button trigger modal -->
        

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Image for Carousel</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="image" class="form-label">Choose Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
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
                      Read Hero
                    </h5>
                   
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add pictures
                    </button>
                    <table class="table table-responsive table-bordered table-striped table-hover mt-2">
                        <thead>
                            <tr>
                                <th class="px-3 py-3 text-center" scope="col"><strong>ID</strong></th>
                                <th class="px-3 py-3 text-center" scope="col"><strong>IMG</strong></th>
                                <th class="px-3 py-3 text-center" scope="col"><strong>Uploaded at</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($res = mysqli_fetch_assoc($carousel_result)) { ?>
                            <tr>
                                <td class="px-3 py-3 text-center" ><?php echo $res['ID']?></td>
                                <td class="px-3 py-3 text-center" ><?php echo $res['image_path']?></td>
                                <td class="px-3 py-3 text-center" ><?php echo $res['uploaded_at']?></td>
                                <td class="px-3 py-3 text-center">
                                    <a href="update.php?id=<?php echo  $res['customerID']?>" class="mx-auto">
                                        <i class="bi bi-pencil-square"></i><i class="bi bi-trash"></i>
                                    </a>
                                  
                                </td>
                            </tr>
                            <?php } ?>    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
    
</body>
</html>