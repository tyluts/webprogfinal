<?php
    require_once('../config.php');
    $news_sql = "SELECT * FROM posts order by date_posted asc";
    $news_sql_result = $con -> query($news_sql);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $description = $_POST['caption'];
        $datetime = $_POST['datetime'];
       
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
                $stmt = $con->prepare("INSERT INTO posts(title, caption, photo, date_posted) VALUES ( ?, ?, ?, ?)");
                $stmt->bind_param("ssss", $title, $description, $targetFilePath, $datetime);
    
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
<style>
    .modal-backdrop {
        display: none !important;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admincss/adminnav.css">
    <title>Home</title>
</head>
<body class="black">
    <?php include 'adminnav.php'; ?>

    <div class="modal fade" id="staticBackdropNews" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropNewsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropNewsLabel">Add News</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="caption" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Choose Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="datetime" class="form-label">Date and Time</label>
                        <input type="date" class="form-control" id="datetime" name="datetime" required>
                        
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
    
            </div>
        </div>
    </div>

     <div class="content" style="padding: 20px; margin-top: 50px; height: calc(100vh - 56px); overflow-y: auto;"> 
      <div class="container my-5 d-flex mx-auto align-items-center justify-content-center">
            <div class="card mx-auto col-12">
                <div class="card-body">
                    <h5 class="card-title">
                      Read News
                    </h5>
                    <div>
                        
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropNews">
                        Add News
                    </button>
                  
                    <table class="table table-responsive table-bordered table-striped table-hover mt-2">
                        <thead>
                            <tr>
                                <th class="px-3 py-3 text-center" scope="col"><strong>ID</strong></th>
                                <th class="px-3 py-3 text-center" scope="col"><strong>TITLE</strong></th>
                                <th class="px-3 py-3 text-center" scope="col"><strong>CAPTION</strong></th>
                                <th class="px-3 py-3 text-center" scope="col"><strong>PHOTO</strong></th>
                                <th class="px-3 py-3 text-center" scope="col"><strong>DATE POSTED</strong></th>
                                <th class="px-3 py-3 text-center" scope="col"><strong>ACTION</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($res = mysqli_fetch_assoc($news_sql_result)) { ?>
                            <tr>
                                <td class="px-3 py-3 text-center" ><?php echo $res['ID']?></td>
                                <td class="px-3 py-3 text-center" ><?php echo $res['title']?></td>
                                <td class="px-3 py-3 text-center" ><?php echo $res['caption']?></td>
                                <td class="px-3 py-3 text-center" ><?php echo $res['photo']?></td>
                                <td class="px-3 py-3 text-center" ><?php echo $res['date_posted']?></td>
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
      </div>  
      
</body>
</html>
