<?php
require_once('config.php');

// Fetch upcoming events
$eventsSql = "SELECT * FROM events WHERE date >= CURDATE() ORDER BY date ASC";
$eventsSqlResult = $con->query($eventsSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - Lyceum of Subic Bay</title>
    
    <!-- Include your CSS files -->
    <link rel="stylesheet" href="css/homecss/color.css">
    <link rel="stylesheet" href="css/eventscss/style.css">
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
    <?php include 'include/navigation.php'; ?>

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
            <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php if($eventsSqlResult->num_rows > 0): ?>
                        <?php 
                        $counter = 0;
                        $isFirst = true;
                        while($event = $eventsSqlResult->fetch_assoc()):
                            if($counter % 3 == 0):
                        ?>
                            <div class="carousel-item <?php echo $isFirst ? 'active' : ''; ?>">
                                <div class="row justify-content-center">
                        <?php 
                            endif;
                            $isFirst = false;
                        ?>
                            <div class="col-md-4">
                                <div class="card event-card dark-grey mx-2">
                                    <img src="admin/<?php echo htmlspecialchars($event['img']); ?>" 
                                         class="event-image" 
                                         alt="<?php echo htmlspecialchars($event['title']); ?>">
                                    <span class="date-badge bg-red">
                                        <?php echo date('M d, Y', strtotime($event['date'])); ?>
                                    </span>
                                    <div class="card-body">
                                        <input type="hidden" class="event_id" value="<?php echo $event['ID']; ?>">
                                        <p class="text-white">
                                            <i class="fas fa-map-marker-alt"></i> 
                                            <?php echo htmlspecialchars($event['loc']); ?>
                                        </p>
                                        <h5 class="card-title text-white">
                                            <?php echo htmlspecialchars($event['title']); ?>
                                        </h5>
                                        <h6 class="card-title text-white">
                                            <?php echo substr(htmlspecialchars($event['description']), 0, 100) . '...'; ?>
                                        </h6>
                                        <button class="btn bg-red text-white view_event">View details</button>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            $counter++;
                            if($counter % 3 == 0 || $counter == $eventsSqlResult->num_rows):
                        ?>
                                </div>
                            </div>
                        <?php 
                            endif;
                        endwhile;
                        ?>
                    <?php else: ?>
                        <div class="carousel-item active">
                            <div class="text-center text-white">No upcoming events found</div>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if($eventsSqlResult->num_rows > 3): ?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Event Details Modal -->
    <div class="modal fade" id="view_event_deets" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title text-white">Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="view_event_deets text-white"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        $('.view_event').click(function(e) {
            e.preventDefault();
            var event_id = $(this).closest('.card-body').find('.event_id').val();
            
            $.ajax({
                method: "POST",
                url: "code.php",
                data: {
                    'click_deets': true,
                    'event_id': event_id
                },
                success: function(response) {
                    $('.view_event_deets').html(response);
                    $('#view_event_deets').modal('show');
                }
            });
        });
    });
    </script>

</body>
</html>

<style>
.event-card {
    transition: transform 0.3s ease;
}

.event-card:hover {
    transform: translateY(-5px);
}

.event-image {
    height: 200px;
    object-fit: cover;
}

.date-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 5px 10px;
    border-radius: 4px;
}

@media (max-width: 768px) {
    .carousel-item .row {
        margin: 0 10px;
    }
    
    .event-card {
        margin-bottom: 20px;
    }
}
</style>