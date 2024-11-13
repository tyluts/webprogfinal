<?php

  
  $eventsSql = "SELECT * FROM events ORDER BY date asc";
  $eventsSqlResult = $con->query($eventsSql);
?>

<div class="container-fluid  mt-4 mb-5 ">
    <div class="row">
        <!-- Card 1 -->
        <?php if($eventsSqlResult->num_rows > 0): ?>
            <?php while($row = $eventsSqlResult-> fetch_assoc()):?>
                <div class="col-md-4">
                    <div class="card event-card dark-grey ms-auto">
                        <img src="https://via.placeholder.com/300x200" alt="Event Image" class="event-image">
                        <span class="date-badge bg-red"><?php echo $row['date'];?></span>
                        <div class="card-body">
                            <input type="hidden" class="user_id" value="<?php echo $row['ID']; ?>">
                            <p class="text-white"><i class="fas fa-map-marker-alt"> <?php echo $row['title'];?></i></p>
                            <h5 class="card-title text-white"><?php echo $row['description'];?></h5>
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>

    $(document).ready(function () {

        $('.view_deets').click(function (e) {
            e.preventDefault();

        
           var user_id = $(this).closest('div').find('.user_id').val();
          

           $.ajax({

            method: "POST",
            url: "./events/modal.php",
            data: {
                'click_view_deets' : true,
                'user_id' : user_id
            },
            success: function (response){
                console.log(response);
            }

           });
        })

    });

</script>
