<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../../include/head.php'; ?>
    <title>Home</title>
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

</style>
</head>
<body class="black">
     <?php include '../navigation.php'; ?>
  
   
     <section>
        <div class="col container mt-5 text-center">
            <div  class="row">
                <h1  class="red montserrat fw-bold">
                    Civil Engineering
                </h1>
            </div>
            <div  class="row">
                <p  class="white hind">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Non accusamus obcaecati mollitia. Voluptatem ullam accusantium cumque non nemo doloremque veniam voluptatum? Aperiam laborum incidunt facilis eos deleniti a voluptatum hic.
                </p>
            </div>
        </div>
    </section>

    <?php include '../social.php'; ?>

      <section>
        <div class="col container-fluid mt-5 text-center">
            <div  class="row">
                <h1  class="red montserrat fw-bold">
                    Curriculum
                </h1>
            </div>
            <div  class="row">
               
            </div>
        </div>
        <?php include '../curriculum.php'; ?>
    </section>

     <?php include '../../include/footer.php'; ?>

</body>
</html>