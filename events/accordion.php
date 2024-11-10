<div class="col container-fluid mt-4 mb-5 ">
    <div class="row ">
        <div class="accordion  mb-5" id="accordionExample">
        <div class="accordion-item dark-grey light-grey">
            <h2 class="accordion-header  ">
            <button class="accordion-button bg-dark text-white montserrat " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Accordion Item #1
            </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="container-fluid mt-4 mb-5 pb-5">
                    <div class="row image-grid" style="margin: 0px;">
                        <!-- Images -->
                        <div class="col-md-4 ">
                        <img src="img/frosh.jpg" alt="Image 1" class="img-fluid" onclick="openModal(this)">
                        </div>
                        <div class="col-md-4">
                        <img src="img/frosh.jpg" alt="Image 2" class="img-fluid" onclick="openModal(this)">
                        </div>
                        <div class="col-md-4 ">
                        <img src="img/frosh.jpg" alt="Image 3" class="img-fluid" onclick="openModal(this)">
                        </div>
                        <div class="col-md-4 ">
                        <img src="img/frosh.jpg" alt="Image 4" class="img-fluid" onclick="openModal(this)">
                        </div>
                        <div class="col-md-4 ">
                        <img src="img/frosh.jpg" alt="Image 5" class="img-fluid" onclick="openModal(this)">
                        </div>
                        <div class="col-md-4 ">
                        <img src="img/frosh.jpg" alt="Image 6" class="img-fluid" onclick="openModal(this)">
                        </div>
                    </div>
                    </div>
            </div>
            </div>
        </div>
        <div class="accordion-item dark-grey light-grey ">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-dark text-white montserrat" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Accordion Item #2
            </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
 <div class="row image-grid" style="margin: 0px;">
                        <!-- Images -->
                        <div class="col-md-4 ">
                        <img src="img/frosh.jpg" alt="Image 1" class="img-fluid" onclick="openModal(this)">
                        </div>
                        <div class="col-md-4">
                        <img src="img/frosh.jpg" alt="Image 2" class="img-fluid" onclick="openModal(this)">
                        </div>
                        <div class="col-md-4 ">
                        <img src="img/frosh.jpg" alt="Image 3" class="img-fluid" onclick="openModal(this)">
                        </div>
                        <div class="col-md-4 ">
                        <img src="img/frosh.jpg" alt="Image 4" class="img-fluid" onclick="openModal(this)">
                        </div>
                        <div class="col-md-4 ">
                        <img src="img/frosh.jpg" alt="Image 5" class="img-fluid" onclick="openModal(this)">
                        </div>
                        <div class="col-md-4 ">
                        <img src="img/frosh.jpg" alt="Image 6" class="img-fluid" onclick="openModal(this)">
                        </div>
                    </div>         
            </div>
            </div>
        </div>
        <div class="accordion-item dark-grey light-grey">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-dark text-white montserrat" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Accordion Item #3
            </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row image-grid" style="margin: 0px;">
                        <!-- Images -->
                        <div class="col-md-4 ">
                        <img src="img/frosh.jpg" alt="Image 1" class="img-fluid" onclick="openModal(this)">
                        </div>
                        <div class="col-md-4">
                        <img src="img/frosh.jpg" alt="Image 2" class="img-fluid" onclick="openModal(this)">
                        </div>
                        <div class="col-md-4 ">
                        <img src="img/frosh.jpg" alt="Image 3" class="img-fluid" onclick="openModal(this)">
                        </div>
                        <div class="col-md-4 ">
                        <img src="img/frosh.jpg" alt="Image 4" class="img-fluid" onclick="openModal(this)">
                        </div>
                        <div class="col-md-4 ">
                        <img src="img/frosh.jpg" alt="Image 5" class="img-fluid" onclick="openModal(this)">
                        </div>
                        <div class="col-md-4 ">
                        <img src="img/frosh.jpg" alt="Image 6" class="img-fluid" onclick="openModal(this)">
                        </div>
                    </div>          
            </div>
            </div>
        </div>
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
