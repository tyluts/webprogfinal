<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php'; ?>
    <title>Home</title>
</head>
<body class="black">
    
  
    <?php include 'include/navigation.php'; ?>
        
    
     <section>
        <?php include 'home/video.php'; ?>
    </section>



    <section>
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
        <?php include 'home/cards.php'; ?>
    </section>
        <?php include 'home/modal.php'; ?>
    <section>
        <div class="col container-fluid mt-5">
            <div  class="row">
                <h1  class="red montserrat fw-bold">
                    Top Programs
                </h1>
            </div>
            <div  class="row">
                <p  class="white hind">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                </p>
            </div>
        </div>
        <?php include 'home/accordion.php'; ?>
    </section>

     <section>
        <?php include 'home/contactform.php'; ?>
    </section>
    
    
    <?php include 'include/footer.php'; ?>
    


    
 
</body>
</html>