<?php
    session_start();
    require_once 'config.php';
    $dept_code = htmlspecialchars($_GET['dept_code']);
    $dept_query = "SELECT * FROM department_programs WHERE dept_code = ?";
    $stmt = $con->prepare($dept_query);
    $stmt->bind_param("s", $dept_code);
    $stmt->execute();
    $result = $stmt->get_result();
    $program = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <?php include 'include/head.php'; ?>
    <title></title>
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
      

    .nav-link:focus, .nav-link:active, .nav-link.show {
        background-color: #6a0000 !important;
        
    }
.bg-red {
    border-radius: 0.5rem;
}
  .image-title {
    text-align: center;
    margin-top: 5px;
    font-size: 14px;
    color: #333;
}
/* Thumbnail styling */
.thumbnail {
    cursor: pointer;
    transition: transform 0.3s ease;
}

/* Full-screen overlay styling */
.overlay {
    display: none; /* Hidden by default */
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.8); /* Dark background */
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.overlay-image {
    max-width: 90%;
    max-height: 90%;
    box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.7);
    transition: transform 0.3s ease;
}

</style>
</head>
<body class="black">
         <?php include 'include/navigation.php'; ?>
        
   <?php
// Include database connection


    $top_programs_sql = "SELECT * FROM top_programs";
    $top_programs_result = $con->query($top_programs_sql);
    $query = "SELECT * FROM hero_section WHERE id = 1";
    $result = mysqli_query($con, $query);
    $hero = mysqli_fetch_assoc($result);

// Get program ID from URL

?>

<div class="container-fluid ">
    <div class="row justify-content-center no-gutters">
        <div class="col-12">
            <div class="position-relative overflow-hidden" 
                 style="height: 50vh; min-height: 300px; max-height: 500px;">
                <img src="admin/<?php echo htmlspecialchars($hero['hero_img']); ?>"
                     alt="<?php echo htmlspecialchars($hero['hero_title']); ?>"
                     class="embed-responsive-item w-100 h-100"
                     style="object-fit: cover;"
                />
                <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" 
                     style="background-color: rgba(0, 0, 0, 0.5);">
                    <div class="text-center text-white p-2 p-md-3">
                        <h2 class="fw-bold  fs-sm-4 fs-md-3 red fs-1"><?php echo htmlspecialchars($hero['hero_title']); ?></h2>
                        <p class="fs-7 fs-sm-6 fs-md-5 mb-2 mb-md-3">
                            <?php echo htmlspecialchars($hero['hero_desc']); ?>
                        </p>
                  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    
    <div class="container my-5">
        <div class="row">
            <div class="col-12 text-center ">
                <h2 class="fw-bold fs-2 red"><?php echo $program['department_title'];?></h2>
                <p class="text-white mt-4"><?php echo $program['dept_desc']?></p>
            </div>
        </div>
    </div>

    <?php
        $dept_code = htmlspecialchars($_GET['dept_code']);
        $programs_query = "SELECT * FROM program_info WHERE dept_code = ?";
        $stmt = $con->prepare($programs_query);
        $stmt->bind_param("s", $dept_code);
        $stmt->execute();
        $programs_result = $stmt->get_result();
        $programs = [];
        while ($row = $programs_result->fetch_assoc()) {
            $programs[] = $row;
        }
    ?>

    <div class="container d-flex align-items-start text-white dark-grey p-5" style="border-radius: 20px">
        <div class="nav flex-column border-pill me-3 col-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <?php foreach ($programs as $index => $program): ?>
                <button class="nav-link m-2 bg-red text-white <?= $index === 0 ? 'active' : '' ?>"
                        id="v-pills-<?= htmlspecialchars($program['course_code']); ?>-tab"
                        data-bs-toggle="pill"
                        data-bs-target="#v-pills-<?= htmlspecialchars($program['course_code']); ?>"
                        type="button"
                        role="tab"
                        aria-controls="v-pills-<?= htmlspecialchars($program['course_code']); ?>"
                        aria-selected="<?= $index === 0 ? 'true' : 'false' ?>">
                    <?= htmlspecialchars($program['program_title']); ?>
                </button>
            <?php endforeach; ?>
        </div>
        <div class="tab-content col-8" id="v-pills-tabContent">
            <?php foreach ($programs as $index => $program): ?>
                <div class="tab-pane fade <?= $index === 0 ? 'show active' : '' ?>"
                    id="v-pills-<?= htmlspecialchars($program['course_code']); ?>"
                    role="tabpanel"
                    aria-labelledby="v-pills-<?= htmlspecialchars($program['course_code']); ?>-tab">
                    <h3 class="fw-bold fs-4 red"><?= htmlspecialchars($program['program_title']); ?></h3>
                    <p class="text-white"><?= htmlspecialchars($program['program_desc']); ?></p>
                    <div class="row">
                        <?php 
                        
                        for ($i = 1; $i <= 4; $i++):
                            $image_field = "curriculum_image" . $i;
                            if (!empty($program[$image_field])):
                                $image_src = htmlspecialchars($program[$image_field]);
                        ?>
                        <div class="col-md-3">
                            <img src="<?= $image_src; ?>" alt="Curriculum Image <?= $i; ?>" class="img-fluid mb-3" />
                        </div>
                        <?php endif; endfor; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


<div id="fullscreenOverlay" class="overlay" onclick="closeFullscreen()">
    <img id="overlayImage" src="" alt="Full-screen view" class="overlay-image">
</div>

    <?php include 'programs/social.php'; ?>
             <div class="footer-wrapper dark-grey">
        <?php include 'include/footer.php'; ?>
    </div>

    
</body>
</html><script>
function openFullscreen(image) {
    // Set the src of the overlay image to the clicked image's src
    document.getElementById("overlayImage").src = image.src;
    // Show the overlay
    document.getElementById("fullscreenOverlay").style.display = "flex";
}

function closeFullscreen() {
    // Hide the overlay
    document.getElementById("fullscreenOverlay").style.display = "none";
}

</script>