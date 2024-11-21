<?php
    require_once('config.php');
$eventsSql = "SELECT * FROM events ORDER BY date DESC LIMIT 6";
$eventsSqlResult = $con->query($eventsSql);

$news_sql = "SELECT * FROM posts ORDER BY date_posted DESC LIMIT 6";
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
   <?php include 'include/navigation.php'; ?>
    
    <section>
        <?php include 'events/video.php'; ?>
    </section>

    <!-- Events Section -->
<section>
    <div class="col container-fluid mt-5">
        <div class="row">
            <h1 class="red montserrat fw-bold">Upcoming Events</h1>
        </div>
        <div class="row">
            <p class="white hind">Upcoming events of Lyceum of Subic Bay.</p>
        </div>
    </div>

    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <?php if($eventsSqlResult->num_rows > 0): ?>
                <?php while($row = $eventsSqlResult->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card event-card dark-grey h-100">
                            <img src="admin/<?php echo htmlspecialchars($row['img']); ?>" 
                                 alt="Event Image" 
                                 class="event-image">
                            <span class="date-badge bg-red">
                                <?php echo htmlspecialchars($row['date']); ?>
                            </span>
                            <div class="card-body">
                                <input type="hidden" class="event_id" value="<?php echo $row['ID']; ?>">
                                <p class="text-white">
                                    <i class="fas fa-map-marker-alt"></i> 
                                    <?php echo htmlspecialchars($row['loc']); ?>
                                </p>
                                <h5 class="card-title text-white">
                                    <?php echo htmlspecialchars($row['title']); ?>
                                </h5>
                                <h6 class="card-title text-white">
                                    <?php echo htmlspecialchars($row['description']); ?>
                                </h6>
                                <button class="btn bg-red text-white view_event" 
                                        data-id="<?php echo $row['ID']; ?>"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#eventModal">
                                    View details
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

    <!-- News Section -->
   <section>
    <div class="col container-fluid mt-5">
        <div class="row">
            <h1 class="red montserrat fw-bold">News</h1>
        </div>
        <div class="row">
            <p class="white hind">Latest news of Lyceum of Subic Bay.</p>
        </div>
    </div>

    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <?php if($news_sql_result->num_rows > 0): ?>
                <?php while($news = $news_sql_result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card event-card dark-grey h-100">
                            <img src="admin/<?php echo htmlspecialchars($news['photo']); ?>" 
                                 alt="News Image" 
                                 class="event-image">
                            <span class="date-badge bg-red">
                                <?php echo htmlspecialchars($news['date_posted']); ?>
                            </span>
                            <div class="card-body">
                                <input type="hidden" class="news_id" value="<?php echo $news['ID']; ?>">
                                <h5 class="card-title text-white">
                                    <?php echo htmlspecialchars($news['title']); ?>
                                </h5>
                                <h6 class="card-title text-white">
                                    <?php echo htmlspecialchars($news['caption']); ?>
                                </h6>
                                <button class="btn bg-red text-white view_news_deets"
                                        data-id="<?php echo $news['ID']; ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#news_deets_modal">
                                    View details
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #23282b; color: #ffffff;">
            <div id="eventDetails" class="">
                    
            </div>
            <div class="modal-footer" style="background-color: #13171a; border-top: 1px solid #343a40;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="news_deets_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #23282b; color: #ffffff;">
            <div class="view_news_details" class="">
               
                
                
            </div>
            <div class="modal-footer" style="background-color: #13171a; border-top: 1px solid #343a40;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


     <?php include 'include/footer.php'; ?>
    <!-- jQuery (required for Bootstrap's JavaScript components) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>

    <!-- Bootstrap JavaScript Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


    </html>
</body>
                    

<script>
   $(document).ready(function() {
    $('.view_event').click(function() {
        var eventId = $(this).closest('.card-body').find('.event_id').val();
        
        $.ajax({
            method: "POST",
            url: "code.php",
            data: {
                'click_deets': true,
                'user_id': eventId // Changed to match what code.php expects
            },
            success: function(response) {
                $('#eventDetails').html(response);
                $('#eventModal').modal('show'); // Explicitly show modal
            }
        });
    });
});
$(document).ready(function() {
    $('.view_news_deets').click(function(e) {
        e.preventDefault();
        var news_id = $(this).closest('.card-body').find('.news_id').val();
        
        $.ajax({
            method: "POST",
            url: "code.php",
            data: {
                'news_deets': true,
                'news_id': news_id
            },
            success: function(response) {
                $('.view_news_details').html(response);
                $('#news_deets_modal').modal('show');
            }
        });
    });
});
</script>
