<div class="container-fluid my-4">
    <!-- Top row with one large image -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="position-relative">
                <img src="img/frosh.jpg" alt="Computer Laboratory" class="grid-image img-fluid w-100"  onclick="openFullscreen(this)"
                     style="height: auto; max-height: 400px; object-fit: cover;">
            </div>
        </div>
    </div>

    <!-- Bottom row with smaller images -->
    <div class="row g-3">
        <div class="col-6 col-md-3 col-lg-3">
            <img src="img/frosh.jpg" alt="Lab Image 1" class="grid-image img-fluid w-100"  onclick="openFullscreen(this)" style="object-fit: cover; max-height: 200px;">
        </div>
        <div class="col-6 col-md-3 col-lg-3">
            <img src="img/frosh.jpg" alt="Lab Image 2" class="grid-image img-fluid w-100"  onclick="openFullscreen(this)" style="object-fit: cover; max-height: 200px;">
        </div>
        <div class="col-6 col-md-3 col-lg-3">
            <img src="img/frosh.jpg" alt="Lab Image 3" class="grid-image img-fluid w-100"  onclick="openFullscreen(this)" style="object-fit: cover; max-height: 200px;">
        </div>
        <div class="col-6 col-md-3 col-lg-3">
            <img src="img/frosh.jpg" alt="Lab Image 4" class="grid-image img-fluid w-100"  onclick="openFullscreen(this)" style="object-fit: cover; max-height: 200px;">
        </div>
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