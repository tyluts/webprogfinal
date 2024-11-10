<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php'; ?>
    <title>Home</title>
</head>
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
        <?php include 'events/cards.php'; ?>
    </section>
    <?php include 'events/modal.php'; ?>
    
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
         <?php include 'events/carousel.php'; ?>
        
    </section>
    
   
    
     <?php include 'include/footer.php'; ?>



</body>
</html>