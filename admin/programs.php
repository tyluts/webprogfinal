<?php
    require_once('../config.php');
    $top_programs_sql = "SELECT * FROM top_programs";
    $top_programs_result = $con->query($top_programs_sql);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $title = $con->real_escape_string($_POST['title']);
        $description = $con->real_escape_string($_POST['description']);
        
        // SQL query to insert data
        $sql = "INSERT INTO top_programs (title, description) VALUES ('$title', '$description')";
    
        if ($con->query($sql) === TRUE) {
            echo "<div class='alert alert-success text-center'>New record created successfully.</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>Error: " . $sql . "<br>" . $con->error . "</div>";
        }
    
        // Close connection
        $con->close();
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
       

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Insert New Program</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <!-- Title Field -->
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" id="title" name="title" class="form-control" maxlength="255" required>
                        </div>
                        
                        <!-- Description Field -->
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            
        </div>

        <div class="container-fluid mt-5 d-flex align-items-center justify-content-center" style="height: calc(100vh - 56px);">
            <div class="card col-12 col-md-8 col-lg-6">
                <div class="card-body">
                    <h5 class="card-title">
                      Read Programs
                    </h5>
                    
                    <div class="col-sm-6 mt-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add new program
                        </button>
                    </div>
                  
                    <table class="table table-responsive table-bordered table-striped table-hover mt-2">
                        <thead>
                            <tr>
                                <th class="px-3 py-3 text-center" scope="col"><strong>ID</strong></th>
                                <th class="px-3 py-3 text-center" scope="col"><strong>TITLE</strong></th>
                                <th class="px-3 py-3 text-center " scope="col"><strong>DESCRIPTION</strong></th>
                                <th class="px-3 py-3 text-center" scope="col"><strong>ACTION</strong></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($res = mysqli_fetch_assoc($top_programs_result)) { ?>
                            <tr>
                                <td class="px-3 py-3 text-center" ><?php echo $res['id']?></td>
                                <td class="px-3 py-3 text-center" ><?php echo $res['title']?></td>
                                <td class="px-3 py-3 text-center" ><?php echo $res['description']?></td>
                                
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