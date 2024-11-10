<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php'; ?>
    <title>Home</title>
      <style>
    .carousel-outer-controls .carousel-control-prev,
.carousel-outer-controls .carousel-control-next {
    width: 10%; /* Make the button smaller */
}

.carousel-outer-controls .carousel-control-prev {
    left: 2rem; /* Position it outside the carousel on the left */
}

.carousel-outer-controls .carousel-control-next {
    right: 2rem; /* Position it outside the carousel on the right */
}

.carousel-inner img {
    height: 100%; /* Ensures images fit within the fixed height */
    object-fit: cover; /* Ensures the image is cropped to fit without distortion */
}

  </style>
</head>
<body class="black">
     <?php include 'include/navigation.php'; ?>
  
    <section>
        
         <?php include 'programs/video.php'; ?>
    </section>

    <section>
          <div class="col container-fluid mt-5">
               <div  class="row">
                    <h1  class="red montserrat fw-bold">
                         Department Programs
                    </h1>
               </div>
               <div  class="row">
                    <p  class="white hind">
                         Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                    </p>
               </div>
          </div>
         <?php include 'programs/card.php'; ?>
    </section>

    
    
     <?php include 'include/footer.php'; ?>

</body>
</html>