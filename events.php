<?php
    require_once('config.php');
    $eventsSql = "SELECT * FROM events order by date asc";
    $eventsSqlResult = $con->query($eventsSql);

    $news_sql = "SELECT * FROM posts order by date_posted asc";
    $news_sql_result = $con->query($news_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    
    <!-- CoreUI CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.2.0/dist/css/coreui.min.css" rel="stylesheet"  crossorigin="anonymous">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Boxicons -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/homecss/color.css">
    <link rel="stylesheet" href="css/homecss/nav.css">
    <link rel="stylesheet" href="css/homecss/footer.css">
    <link rel="stylesheet" href="css/homecss/card.css">
    <link rel="stylesheet" href="css/homecss/video.css">
    <link rel="stylesheet" href="css/homecss/contactform.css">
    <link rel="stylesheet" href="css/programcss/accordion.css">
    <link rel="stylesheet" href="css/eventscss/grid.css">
    <link rel="stylesheet" href="css/aboutuscss/carousel.css">
    <link rel="stylesheet" href="css/aboutuscss/grid.css">
    <link rel="stylesheet" href="css/colors.css">
</head>


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


    <!------- news modal--------->
    <div class="modal fade" id="news_deets_modal" tabindex="-1" aria-labelledby="news_deets_modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
            <div class="modal-header bg-dark text-white ">
                <h1 class="modal-title fs-5" id="news_deets_modalLabel">News</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-dark text-white">
                <div class="view_news_details">

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
                    Upcoming events of Lyceum of Subic Bay. 
                </p>
            </div>
        </div>
        <div class="container mt-4 mb-5 ">
        <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php if($eventsSqlResult->num_rows > 0): ?>
                    <?php 
                    $isFirst = true; // Track the first item for active class 
                    $counter = 0; // Counter to group cards in sets of 2
                    ?>
                    <?php while($row = $eventsSqlResult->fetch_assoc()): ?>
                        <?php if ($counter % 3 == 0): // Start a new carousel item for every 2 events ?>
                            <div class="carousel-item <?php echo $isFirst ? 'active' : ''; ?>">
                                <div class="d-flex justify-content-center">
                        <?php endif; ?>

                            <div class="card event-card dark-grey mx-2" style="width: 410px;">
                                <img src="./admin/<?php echo $row['img'] ?>" alt="Event Image" class="event-image">
                                <span class="date-badge bg-red"><?php echo $row['date']; ?></span>
                                <div class="card-body">
                                    <input type="hidden" class="user_id" value="<?php echo $row['ID']; ?>">
                                    <p class="text-white"><i class="fas fa-map-marker-alt"></i> <?php echo $row['loc']; ?></p>
                                    <h5 class="card-title text-white"><?php echo $row['title']; ?></h5>
                                    <h6 class="card-title text-white"><?php echo $row['description']; ?></h6>
                                    <a class="btn bg-red text-white view_deets">View details</a>
                                </div>
                            </div>

                        <?php if ($counter % 3 == 2 || $counter == $eventsSqlResult->num_rows - 1): // Close the carousel item every 2 events ?>
                                </div>
                            </div>
                            <?php $isFirst = false; // Set isFirst to false after the first iteration ?>
                        <?php endif; ?>
                        <?php $counter++; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="carousel-item active">
                        <div class="text-center text-white">No announcements found</div>
                    </div>
                <?php endif; ?>
            </div>
        
            <!-- Carousel controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
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
                    Latest news of Lyceum of Subic Bay. 
                </p>
            </div>
        </div><div class="container-fluid  mt-4 mb-5 ">
            <div class="row d-flex justify-content-center">
                <!-- Card 1 -->
                <?php if($news_sql_result->num_rows > 0): ?>
                    <?php while($news = $news_sql_result-> fetch_assoc()):?>
                        <div class="col-md-4">
                            <div class="card event-card dark-grey ms-auto my-3">
                                <img src="./admin/<?php echo $news['photo'] ?>" alt="Event Image" class="event-image">
                                <span class="date-badge bg-red"><?php echo $news['date_posted'];?></span>
                                <div class="card-body">
                                    <input type="hidden" class="news_id" value="<?php echo $news['ID']; ?>">
                                    <h5 class="card-title text-white"><?php echo $news['title'];?></h5>
                                    <h6 class="card-title text-white"><?php echo $news['caption'];?></h5>
                                    <a class="btn bg-red text-white view_news_deets">
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

    

     
    <!-- jQuery (required for Bootstrap's JavaScript components) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>

    <!-- Bootstrap JavaScript Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


                    
</body>
</html>
<script>
    $(document).ready(function () {
        $('.view_deets').click(function (e) {
            e.preventDefault();

            
            var user_id = $(this).closest('div').find('.user_id').val();
            /*console.log(user_id);*/

            $.ajax({
                method: "POST",
                url: "code.php",
                data: {
                    'click_deets': true,
                    'user_id': user_id
                },
                success: function (response){
                    /*console.log(response);*/

                    $('.view_event_deets').html(response);
                    $('#view_event_deets').modal('show');
                }
            });
        });
    });

    $(document).ready(function () {
        $('.view_news_deets').click(function (e) {
            e.preventDefault();

            var news_id = $(this).closest('div').find('.news_id').val();

            $.ajax({
                method: "POST",
                url: "code.php",
                data: {
                    'news_deets': true,
                    'news_id': news_id 
                },
                success: function (response){
                    $('.view_news_details').html(response);
                    $('#news_deets_modal').modal('show');
                }
            });
        });
    });
</script>
