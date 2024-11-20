<?php
require_once 'config.php';

// Fetch facilities data
$query = "SELECT * FROM facilities_section WHERE id = 4";
$result = mysqli_query($con, $query);
$facility = mysqli_fetch_assoc($result);

// Set default values if no data found
if (!$facility) {
    $facility = [
        'facility_title' => 'Our Facilities',
        'facility_desc' => 'View our state-of-the-art facilities',
        'facility_image1' => 'img/frosh.jpg',
        'facility_image2' => 'img/frosh.jpg',
        'facility_image3' => 'img/frosh.jpg',
        'facility_image4' => 'img/frosh.jpg',
        'facility_image5' => 'img/frosh.jpg'
    ];
}
?>

<div class="container-fluid my-4">
    <!-- Facility Title and Description -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="montserrat red fs-1 fw-bold"><?php echo htmlspecialchars($facility['facility_title']); ?></h2>
            <p class="hind white"><?php echo htmlspecialchars($facility['facility_desc']); ?></p>
        </div>
    </div>

    <!-- Top row with one large image -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="position-relative">
                <img src="admin/<?php echo htmlspecialchars($facility['facility_image1']); ?>" 
                     alt="<?php echo htmlspecialchars($facility['facility_title']); ?>" 
                     class="grid-image img-fluid w-100" 
                     onclick="openFullscreen(this)"
                     style="height: auto; max-height: 400px; object-fit: cover;">
            </div>
        </div>
    </div>

    <!-- Bottom row with smaller images -->
    <div class="row g-3">
        <?php for($i = 2; $i <= 5; $i++) { 
            $image_key = 'facility_image' . $i;
        ?>
            <div class="col-6 col-md-3 col-lg-3">
                <img src="admin/<?php echo htmlspecialchars($facility[$image_key]); ?>" 
                     alt="<?php echo htmlspecialchars($facility['facility_title']) . ' Image ' . $i; ?>" 
                     class="grid-image img-fluid w-100" 
                     onclick="openFullscreen(this)"
                     style="object-fit: cover; max-height: 200px;">
            </div>
        <?php } ?>
    </div>
</div>

<div id="fullscreenOverlay" class="overlay" onclick="closeFullscreen()">
    <img id="overlayImage" src="" alt="Full-screen view" class="overlay-image">
</div>

<style>
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