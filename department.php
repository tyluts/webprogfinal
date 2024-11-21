
<!DOCTYPE html>
<html lang="en">
<head>
     <?php include 'include/head.php'; ?>
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
require_once 'config.php';

    $top_programs_sql = "SELECT * FROM top_programs";
    $top_programs_result = $con->query($top_programs_sql);
$query = "SELECT * FROM hero_section WHERE id = 1";
$result = mysqli_query($con, $query);
$hero = mysqli_fetch_assoc($result);

// Get program ID from URL


try {
    $query = "SELECT curriculum_image1, curriculum_image2, curriculum_image3, curriculum_image4 
              FROM program_info WHERE course_code = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $program_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $program = $result->fetch_assoc();

    // Debug
    error_log("Program Images for ID $program_id: " . print_r($program, true));
} catch (Exception $e) {
    error_log("Error fetching curriculum: " . $e->getMessage());
    $program = null;
}

?>

<div class="container-fluid m-5">
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
            <h2 class="fw-bold fs-2 red">Department Programs</h2>
            <p class="text-white mt-4">Explore our diverse range of programs designed to empower students with the knowledge and skills needed to excel in their chosen fields. Our programs are tailored to meet the needs of today's dynamic job market and provide hands-on learning experiences.</p>
        </div>
    </div>
</div>

 <div class="container d-flex align-items-start text-white dark-grey     p-5" style="border-radius: 20px">
        <div class=" nav flex-column   border-pill me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
       <button class="nav-link active m-2 bg-red text-white btn-success" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</button>
            <button class="nav-link m-2 bg-red text-white " id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile " aria-selected="false">Profile</button>
            <button class="nav-link m-2 bg-red text-white" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</button>
          
        </div>
        <div class="tab-content " id="v-pills-tabContent">
            <div class="tab-pane fade show active " id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                 <h3 class="fw-bold fs-4 red">Home</h3>
            <p class=" ">Welcome to the Home tab. Here you can find information about our department programs and other relevant details.</p>
            <div class="container-fluid mx-auto mt-5">
    <div class="row  image-grid justify-content-center" style="margin: 0px;">
        <?php 
        $years = ['1st Year', '2nd Year', '3rd Year', '4th Year'];
        for($i = 1; $i <= 4; $i++): 
            $image_field = 'curriculum_image' . $i;
            // Debug image path
            error_log("Image $i path: " . ($program[$image_field] ?? 'not set'));
            $image_src = ($program && !empty($program[$image_field])) ? 
                        "admin/" . $program[$image_field] : 
                        "img/frosh.jpg";
        ?>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3 image-container">
            <img src="<?php echo htmlspecialchars($image_src); ?>" 
                 alt="<?php echo $years[$i-1]; ?>" 
                 class="img-fluid thumbnail" 
                 style="height: 150px; width: 100%; " 
                 onclick="openFullscreen(this)">
            <p class="image-title text-white"><?php echo $years[$i-1]; ?></p>
        </div>
        <?php endfor; ?>
    </div>
</div>

<div id="fullscreenOverlay" class="overlay" onclick="closeFullscreen()">
    <img id="overlayImage" src="" alt="Full-screen view" class="overlay-image">
</div>
            </div>
            <div class="tab-pane fade " id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus necessitatibus, in laborum expedita perferendis molestiae sequi laboriosam asperiores quas vitae ipsum sapiente ut commodi harum voluptas aspernatur nemo sed quis.</div>
            <div class="tab-pane fade bg-red" id="v-pills-disabled" role="tabpanel" aria-labelledby="v-pills-disabled-tab" tabindex="0">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis porro iusto, pariatur similique quas aut, architecto corrupti necessitatibus aliquid neque voluptatum blanditiis, illo vel voluptatibus modi deserunt ullam officia? Sint.</div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis repellat quas deleniti a nisi provident officia, blanditiis eveniet ipsa voluptate beatae? Sapiente consequatur quas incidunt dolorem, magnam necessitatibus dolore placeat.</div>
            
        </div>
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