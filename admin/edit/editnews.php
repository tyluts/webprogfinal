<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../../include/head.php'; ?>
    <link rel="stylesheet" href="../add/css/admincss/adminnav.css">
    <title>Home</title>
</head>
<body class="black">
    <?php include 'editadminnav.php'; ?>

    <div class="content  " style="padding: 20px; margin-top: 50px; height: calc(100vh - 56px); overflow-y: auto;">
     <div class="container mt-5">
        <div class="card">
          
        <div class="card-body">
        <h5 class="card-title">Edit News</h5>
        <form class="" method="post" action="update.php?id=<?php echo $id ?>">
            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="FirstName" placeholder="First Name" name="firstname" value="<?php echo $resultData['firstName']; ?>" required>
                </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="LastName" placeholder="Last Name" name="lastname" value="<?php echo $resultData['LastName']; ?>"  required>
                    </div>
                </div>
            <div class="form-group row">
                <div class="col-sm-6 mt-2">
                    <select class="form-select" name="shoes"   aria-label="Default select example">
                    <option selected hidden  ><?php echo $resultData['shoes'] ?></option>
                    <option value="nike">Nike</option>
                    <option value="adidas">Adidas</option>
                    <option value="asics">Asics</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mt-2">
                    <input type="email" class="form-control form-control-user" id="Email" placeholder="Email Address" name="email" value="<?php echo $resultData['email']; ?>"  required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mt-2">
                    <button type="submit" name="update" class="btn btn-secondary text-white btn-user text-dark btn-block mt-20">Update Record</button>
                </div>
            </div>
        </form>
    </div>
      
      
        
    
</body>
</html>