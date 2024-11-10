<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/head.php'; ?>
    <link rel="stylesheet" href="../css/admincss/adminnav.css">
    <title>Home</title>
</head>
<body class="black">
    <?php include 'adminnav.php'; ?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/head.php'; ?>
    <link rel="stylesheet" href="../css/admincss/adminnav.css">
    <title>Home</title>
</head>
<body class="black">
    <?php include 'adminnav.php'; ?>



     <div class="content  " style="padding: 20px; margin-top: 50px; height: calc(100vh - 56px); overflow-y: auto;"> 
      <div class="container my-5 d-flex mx-auto align-items-center justify-content-center">
            <div class="card mx-auto col-12">
                <div class="card-body">
                    <h5 class="card-title">
                      Read Hero
                    </h5>
                    <div>
                        <a href="edit/editprograms.php?id=<?php echo  $res['customerID']?>" class="mx-auto">
                                        <i class="bi bi-pencil-square">test edit button</i>
                                    </a>
                    </div>
                    <div class="col-sm-6 mt-2">
                        <a  href="add/addprograms.php" class="btn btn-secondary text-white btn-user text-dark btn-block mt-20">Add Record</a>
                    </div>
                  
                    <table class="table table-responsive table-bordered table-striped table-hover mt-2">
                        <thead>
                            <tr>
                                <th class="px-3 py-3 text-center" scope="col"><strong> </strong></th>
                                <th class="px-3 py-3 text-center" scope="col"><strong></strong></th>
                                <th class="px-3 py-3 text-center" scope="col"><strong> </strong></th>
                                <th class="px-3 py-3 text-center" scope="col"><strong> </strong></th>
                                <th class="px-3 py-3 text-center" scope="col"><strong></strong></th>
                                <th class="px-3 py-3 text-center" scope="col"><strong></strong></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($res = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td class="px-3 py-3 text-center" ><?php echo $res['']?></td>
                                <td class="px-3 py-3 text-center" ><?php echo $res['']?></td>
                                <td class="px-3 py-3 text-center" ><?php echo $res['']?></td>
                                <td class="px-3 py-3 text-center" ><?php echo $res['']?></td>
                                <td class="px-3 py-3 text-center" ><?php echo $res['']?></td>
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
      </div>  
    
</body>
</html>
    
</body>
</html>