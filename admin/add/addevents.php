<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../../include/head.php'; ?>
    <link rel="stylesheet" href="../add/css/admincss/adminnav.css">
    <title>Home</title>
</head>
<body class="black">
    <?php include 'addadminnav.php'; ?>

    <div class="content  " style="padding: 20px; margin-top: 50px; height: calc(100vh - 56px); overflow-y: auto;">
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Add Events</h5>
            
            <form class="" method="post" action="create.php">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="FirstName" placeholder="First Name" name="firstname" required>
                    </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" id="LastName" placeholder="Last Name" name="lastname" required>
                        </div>
                    </div>
                <div class="form-group row">
                    <div class="col-sm-6 mt-2">
                        <select class="form-select" name="shoes" aria-label="Default select example">
                        <option selected>Choose Shoes</option>
                        <option value="nike">Nike</option>
                        <option value="adidas">Adidas</option>
                        <option value="asics">Asics</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mt-2">
                        <input type="email" class="form-control form-control-user" id="Email" placeholder="Email Address" name="email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mt-2">
                        <button type="submit" name="add" class="btn btn-secondary text-white btn-user text-dark btn-block mt-20">Add Record</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
      </div>
      
      
        
    
</body>
</html>