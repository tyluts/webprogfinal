<section class="">
    <div class="col container-fluid mt-5">
        <div class="row">
            <h1 class="red montserrat fw-bold">News</h1>
        </div>
        <div class="row">
            <p class="white hind">Latest news of Lyceum of Subic Bay.</p>
        </div>
    </div>
    <div class="container-fluid mt-4 mb-5 px-0">
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row d-flex justify-content-center">
                        <?php if($news_sql_result->num_rows > 0): ?>
                            <?php 
                            $counter = 0;
                            while($news = $news_sql_result->fetch_assoc()): 
                                if ($counter > 0 && $counter % 3 == 0):
                            ?>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row d-flex justify-content-center">
                            <?php 
                                endif;
                                $counter++;
                            ?>
                                <div class="col-md-4" style="max-width: 410px;">
                                    <div class="card event-card dark-grey ms-auto my-3">
                                        <img src="./admin/<?php echo $news['photo'] ?>" alt="Event Image" class="event-image">
                                        <span class="date-badge bg-red"><?php echo $news['date_posted']; ?></span>
                                        <div class="card-body">
                                            <input type="hidden" class="news_id" value="<?php echo $news['ID']; ?>">
                                            <h5 class="card-title text-white"><?php echo $news['title']; ?></h5>
                                            <h6 class="card-title text-white"><?php echo $news['caption']; ?></h6>
                                            <a class="btn bg-red text-white view_news_deets">View details</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p class="text-center">No announcements found</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

<!-- News Modal -->
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

<script>
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