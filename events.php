<?php
    
    require_once('config.php');
    $eventsSql = "SELECT * FROM events order by date asc";
    $eventsSqlResult = $con->query($eventsSql);
?>

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

    <!-------- view modal--------->
    <div class="modal fade" id="view_event_deets" tabindex="-1" aria-labelledby="view_event_deetsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-white" id="view_event_deetsLabel">Event Details</h1>
                <button type="button" class="btn-close custom-close-button" data-bs-dismiss="modal" style="color:white;" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-dark">
                <div class="view_event_deets text-white">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

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
        <div class="container-fluid  mt-4 mb-5 ">
            <div class="row d-flex justify-content-center">
                <!-- Card 1 -->
                <?php if($eventsSqlResult->num_rows > 0): ?>
                    <?php while($row = $eventsSqlResult-> fetch_assoc()):?>
                        <div class="col-md-4">
                            <div class="card event-card dark-grey ms-auto my-3">
                                <img src="./admin/<?php echo $row['img'] ?>" alt="Event Image" class="event-image">
                                <span class="date-badge bg-red"><?php echo $row['date'];?></span>
                                <div class="card-body">
                                    <input type="hidden" class="user_id" value="<?php echo $row['ID']; ?>">
                                    <p class="text-white"><i class="fas fa-map-marker-alt"> <?php echo $row['loc'];?></i></p>
                                    <h5 class="card-title text-white"><?php echo $row['title'];?></h5>
                                    <h6 class="card-title text-white"><?php echo $row['description'];?></h5>
                                    <a class="btn bg-red text-white view_deets">
                                        View details
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No announcements found</td>
                    </tr>
                <?php endif; ?>
            </div>
        </div>

    </section>

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
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</html>
<script>

    $(document).ready(function () {

        $('.view_deets').click(function (e) {
            e.preventDefault();

        
           var user_id = $(this).closest('div').find('.user_id').val();
           /*console.log(user_id);*/

           $.ajax({

            method: "POST",
            url: "./events/modal.php",
            data: {
                'click_view_deets' : true,
                'user_id' : user_id
            },
            success: function (response){
               $('.view_event_deets').html(response);
               $('#view_event_deets').modal('show')
            }

           });
        })

    });

</script>
