<div class="container-fluid my-4">
        <!-- Top row with one large image -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="position-relative" >
                    <img src="img/frosh.jpg" alt="Computer Laboratory" class="grid-image" onclick="openModal(this)"style="height: 500px;">
                    
                </div>
            </div>
        </div>

        <!-- Bottom row with smaller images -->
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <img src="img/frosh.jpg" alt="Lab Image 1" class="grid-image" onclick="openModal(this)">
            </div>
            <div class="col-6 col-md-3">
                <img src="img/frosh.jpg" alt="Lab Image 2"class="grid-image" onclick="openModal(this)">
            </div>
            <div class="col-6 col-md-3">
                <img src="img/frosh.jpg" alt="Lab Image 3" class="grid-image" onclick="openModal(this)">
            </div>
            <div class="col-6 col-md-3">
                <img src="img/frosh.jpg" alt="Lab Image 4" class="grid-image" onclick="openModal(this)">
            </div>
        </div>
    </div>
<!-- Modal Structure -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog custom-modal-size">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <!-- Adjust image size within modal -->
        <img id="modalImage" src="" alt="Larger image" class="img-fluid enlarged-image">
      </div>
    </div>
  </div>
</div>

<script>
  function openModal(image) {
    // Set the src of the modal image to the clicked image's src
    document.getElementById("modalImage").src = image.src;
    // Show the modal
    var imageModal = new bootstrap.Modal(document.getElementById("imageModal"));
    imageModal.show();
  }
</script>