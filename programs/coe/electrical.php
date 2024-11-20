
<?php
// Pass program ID when including curriculum.php
$_GET['id'] = 2; // Set to appropriate program ID
require_once('../../config.php');
$query = "SELECT * FROM program_info WHERE id = 2";
$result = $con->query($query);
$program = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <?php include '../../include/head.php'; ?>
    <title>Civil Engineering - LSB</title>
    <!-- Make sure footer CSS is loaded -->
 <link rel="stylesheet" href="../../css/colors.css">
    <link rel="stylesheet" href="../../css/homecss/color.css">
    <link rel="stylesheet" href="../../css/homecss/footer.css">
    <link rel="stylesheet" href="../../css/programcss/civil.css">
    <style>
.custom-carousel-wrapper {
  position: relative;
}

.custom-carousel-control {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 2;
  width: 40px; /* Adjust size as needed */
}


.custom-carousel-control.carousel-control-prev {
  left: -50px; /* Adjust this to move the left arrow further out */
}

.custom-carousel-control.carousel-control-next {
  right: -50px; /* Adjust this to move the right arrow further out */
}

</style>
</head>
<body class="black">
         <?php include '../navigation.php'; ?>
  
   
<section>
    <div class="col container mt-5 text-center">
        <div class="row">
            <h1 class="red montserrat fw-bold">
                <?php echo htmlspecialchars($program['program_title'] ); ?>
            </h1>
        </div>
        <div class="row">
            <p class="white hind">
                <?php echo htmlspecialchars($program['program_desc']);  ?>
            </p>
        </div>
    </div>
</section>

    <?php include '../social.php'; ?>

      <section>
        <div class="col container-fluid mt-5 text-center">
            <div  class="row">
                <h1  class="red montserrat fw-bold">
                    <?php echo htmlspecialchars($program['curriculum_title']); ?>
                </h1>
            </div>

        </div>
        <?php include '../curriculum.php'; ?>
    </section>

             <div class="footer-wrapper dark-grey">
        <?php include '../../include/footer.php'; ?>
    </div>

    
</body>
</html>