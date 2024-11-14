<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php'; ?>
    <title>Home</title>
</head>

<body class="black">

    <section>
        <?php include('events.php') ?>
    </section>

        <?php include 'home/modal.php'; ?>


    
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
            <?php include 'home/accordion.php'; ?>
        </div>

</body>
</html>