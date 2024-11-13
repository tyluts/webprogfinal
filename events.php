<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php'; ?>
    <title>Home</title>
</head>
<style>
      .custom-modal-size {
    max-width: 60%; /* Makes modal take up 90% of the screen width */
  }

  /* Custom style to make image within modal larger */
  .enlarged-image {
    max-width: 100%; /* Makes image take up the full width of the modal */
    height: 550px; /* Keeps aspect ratio */
  }
</style>
<body class="black">
     <?php include 'include/navigation.php'; ?>
  
    <section>
         <?php include 'events/video.php'; ?>
    </section>


    <section class="">
         <div class="col container-fluid mt-5">
            <div  class="row">
                <h1  class="red montserrat fw-bold">
                    Upcoming Events
                </h1>
            </div>
            <div  class="row">
                <p  class="white hind">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                </p>
            </div>
        </div>
        <?php include 'events/eventcards.php'; ?>
    </section>
    <?php include 'events/modal.php'; ?>

    <section class="">
         <div class="col container-fluid mt-5">
            <div  class="row">
                <h1  class="red montserrat fw-bold">
                    News
                </h1>
            </div>
            <div  class="row">
                <p  class="white hind">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                </p>
            </div>
        </div>
        <?php include 'events/newscards.php'; ?>
    </section>

    <section class=" mb-5">
        <div class="col container-fluid mt-5">
            <div  class="row">
                <h1  class="red montserrat fw-bold">
                    Past Events
                </h1>
            </div>
            <div  class="row">
                <p  class="white hind">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                </p>
            </div>
        </div>
         <?php include 'events/accordion.php'; ?>
        
    </section>
    
   
    
     <?php include 'include/footer.php'; ?>



</body>
</html>