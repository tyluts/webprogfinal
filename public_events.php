<!-- FILE: public_events.php -->


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
            <?php 
            $count = 0;
            if($eventsSqlResult->num_rows > 0):
                while($row = $eventsSqlResult->fetch_assoc()): 
                    $count++;
            ?>
                <div class="col-md-4">
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
            <?php 
                endwhile;
            endif;
            
            // Fill remaining slots with placeholder cards
            while($count < 3): 
                $count++;
            ?>
                <div class="col-md-4">
                    <div class="card event-card dark-grey h-100">
                        <div class="card-body text-center text-white d-flex align-items-center justify-content-center">
                            <p class="mb-0">No upcoming event</p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- Rest of the modal and script code remains the same -->

<!-- Event Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white">Event Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-white">
                <div id="eventDetails"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

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
</script>