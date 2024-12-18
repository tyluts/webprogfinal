<?php
session_start();

// Check if 'course_code' is provided
if (isset($_GET['course_code']) && !empty($_GET['course_code'])) {
    $courseCode = htmlspecialchars($_GET['course_code']);
} else {
    die("Error: 'course_code' parameter is missing or empty.");
}

require_once('../config.php');

// Fetch program information
$stmt = $con->prepare("SELECT * FROM program_info WHERE course_code = ?");
$stmt->bind_param("s", $courseCode);
$stmt->execute();
$result = $stmt->get_result();

$program = $result->fetch_assoc();

if ($program) {
    // Sanitize data for safe HTML output
    $programTitle = htmlspecialchars($program['program_title']);
    $programDesc = htmlspecialchars($program['program_desc']);
    $curriculumTitle = htmlspecialchars($program['curriculum_title']);
} else {
    $programTitle = "Program Not Found";
    $programDesc = "We could not find the requested program.";
    $curriculumTitle = "No Curriculum Available";
}

// Close the statement
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/head.php'; ?>
    <title><?php echo $programTitle; ?> - LSB</title>
    <link rel="stylesheet" href="../css/colors.css">
    <link rel="stylesheet" href="../css/homecss/color.css">
    <link rel="stylesheet" href="../css/homecss/footer.css">
    <link rel="stylesheet" href="../css/programcss/civil.css">
</head>
<body class="black">
    <nav class="navbar navbar-expand-lg mx-auto  my-4 nav-width border-radius sticky-top dark-grey   ">
        <div class="container-fluid ">
            <!-- Logo Section -->
            <a class="navbar-brand" href="#">
                <img src="../img/favicon.png" alt="Logo" width="30" class="d-inline-block align-text-top">
            </a>

            <!-- Offcanvas Toggle Button for Mobile View -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Offcanvas Component -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body dark-grey ">
                    <!-- Navbar Links Inside Offcanvas for Mobile -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item mx-2">
                            <a class="nav-link white " href="index.php">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link  white" href="programs.php">Programs</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link white " href="events.php">Events</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link white " href="aboutus.php">About Us</a>
                        </li>
                    </ul>
                    
                    <!-- Login Link (Optional) -->
                    <div class="navbar-nav login-nav border-radius ms-2">
                        <a class="nav-link login-link bg-red border-radius d-inline-flex align-items-center justify-content-center" href="#" style="width: 40px; height: 40px; padding: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-right-dots-fill" viewBox="0 0 16 16">
                                <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353zM5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 2 0m3 1a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </nav>
    <!-- Program Title and Description -->
    <section>
        <div class="container mt-5 text-center">
            <div class="row">
                <h1 class="red montserrat fw-bold">
                    <?php echo $programTitle; ?>
                </h1>
            </div>
            <div class="row">
                <p class="white hind">
                    <?php echo $programDesc; ?>
                </p>
            </div>
        </div>
    </section>

    <?php include 'social.php'; ?>

    <!-- Curriculum Section -->
    <section>
        <div class="container-fluid mt-5 text-center">
            <div class="row">
                <h1 class="red montserrat fw-bold">
                    <?php echo $curriculumTitle; ?>
                </h1>
            </div>
        </div>

        <!-- Image Grid -->
        <div class="container-fluid mx-auto mt-5">
            <div class="row image-grid justify-content-center" style="margin: 0px;">
                <?php 
                $years = ['1st Year', '2nd Year', '3rd Year', '4th Year'];
                for ($i = 1; $i <= 4; $i++): 
                    $image_field = 'curriculum_image' . $i;
                    $image_src = ($program && !empty($program[$image_field])) ? 
                                 "../admin/" . $program[$image_field] : 
                                 "../img/frosh.jpg";
                    
                    // Debug: Log resolved image paths
                    error_log("Resolved image path for Year $i: " . $image_src);
                ?>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3 image-container">
                    <img src="<?php echo htmlspecialchars($image_src); ?>" 
                         alt="<?php echo $years[$i-1]; ?>" 
                         class="img-fluid thumbnail" 
                         style="height: 150px; width: 100%;" 
                         onclick="openFullscreen(this)">
                    <p class="image-title text-white"><?php echo $years[$i-1]; ?></p>
                </div>
                <?php endfor; ?>
            </div>
        </div>

        <!-- Fullscreen Overlay -->
        <div id="fullscreenOverlay" class="overlay" onclick="closeFullscreen()">
            <img id="overlayImage" src="" alt="Full-screen view" class="overlay-image">
        </div>
    </section>

    <!-- Footer -->
    <div class="footer-wrapper dark-grey">
        <?php include '../include/footer.php'; ?>
    </div>

    <!-- JavaScript -->
    <script>
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
</body>

<!-- CSS Styling -->
<style>
.image-title {
    text-align: center;
    margin-top: 5px;
    font-size: 14px;
    color: #fff;
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
</html>
