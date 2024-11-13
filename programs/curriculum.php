<div class="container-fluid mx-auto mt-5">
    <div class="row image-grid justify-content-center" style="margin: 0px;">
        
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3 image-container">
            <img src="../../img/frosh.jpg" alt="Image 1" class="img-fluid thumbnail" style="height: 150px; width: 100%;" onclick="openFullscreen(this)">
            <p class="image-title text-white">1st Year</p>
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3 image-container">
            <img src="../../img/frosh.jpg" alt="Image 2" class="img-fluid thumbnail" style="height: 150px; width: 100%;" onclick="openFullscreen(this)">
            <p class="image-title text-white">2nd Year</p>
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3 image-container">
            <img src="../../img/frosh.jpg" alt="Image 3" class="img-fluid thumbnail" style="height: 150px; width: 100%;" onclick="openFullscreen(this)">
            <p class="image-title text-white">3rd Year</p>
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3 image-container">
            <img src="../../img/frosh.jpg" alt="Image 4" class="img-fluid thumbnail" style="height: 150px; width: 100%;" onclick="openFullscreen(this)">
            <p class="image-title text-white"> 4th Year</p>
        </div>
      
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
