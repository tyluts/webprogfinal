<?php 
require_once('../config.php');

$carousel_sql = "SELECT * FROM images";
$carousel_result = $con->query($carousel_sql);

if (isset($_POST['image_form'])) {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $imageName = basename($image['name']); 
        $imageTmpPath = $image['tmp_name'];    
        $uploadDir = 'img/';                   

        // Ensure the upload directory exists
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);  // Create directory if not exists
        }

        // Set the target file path and normalize the file path
        $targetFilePath = $uploadDir . $imageName;
        $targetFilePath = str_replace('\\', '/', $targetFilePath); 

        if (move_uploaded_file($imageTmpPath, $targetFilePath)) {
            // Prepare SQL query to insert the image path into the database
            $stmt = $con->prepare("INSERT INTO images (image_path) VALUES (?)");
            $stmt->bind_param("s", $targetFilePath);  // Bind the image path as a string

            // Execute the query
            if ($stmt->execute()) {
                echo "<p style='color: green;'>Image uploaded successfully!</p>";
            } else {
                echo "<p style='color: red;'>Database Error: " . $stmt->error . "</p>";
            }
        } else {
            echo "<p style='color: red;'>Failed to move uploaded file. Please try again.</p>";
        }
    } else {
        echo "<p style='color: red;'>File Error: " . $_FILES['image']['error'] . "</p>";
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
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="css/homecss/color.css">
    <title>Image Upload</title>
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
                                <td class="px-3 py-3 text-center" ><?php echo $res['id']?></td>
                                <td class="px-3 py-3 text-center" >
                                    <?php if (!empty($res['image_path'])): ?>
                                        <img src="<?php echo htmlspecialchars($res['image_path']); ?>" alt="News Photo" style="max-width: 100px; max-height: 100px;">
                                    <?php else: ?>
                                        No Photo
                                    <?php endif; ?>
                                </td>
                                <td class="px-3 py-3 text-center" ><?php echo $res['uploaded_at']?></td>
                                <td class="px-3 py-3 text-center">
                                    <a class="mx-auto">
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