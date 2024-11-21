<?php


// Get program ID from URL
$program_id = $_GET['course_code'];// Default to ID 1 if not specified

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

<div class="container-fluid mx-auto mt-5">
    <div class="row image-grid justify-content-center" style="margin: 0px;">
        <?php 
        $years = ['1st Year', '2nd Year', '3rd Year', '4th Year'];
        for($i = 1; $i <= 4; $i++): 
            $image_field = 'curriculum_image' . $i;
            // Debug image path
            error_log("Image $i path: " . ($program[$image_field] ?? 'not set'));
            $image_src = ($program && !empty($program[$image_field])) ? 
                        "../../admin/" . $program[$image_field] : 
                        "../../img/frosh.jpg";
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

<div id="fullscreenOverlay" class="overlay" onclick="closeFullscreen()">
    <img id="overlayImage" src="" alt="Full-screen view" class="overlay-image">
</div>
<style>
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
