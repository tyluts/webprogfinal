<!-- FILE: include_news.php -->
<?php
// Fetch news
$news_sql = "SELECT * FROM posts ORDER BY date_posted ASC LIMIT 3";
$news_sql_result = $con->query($news_sql);
?>

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
                    <div class="col-md-4">
                        <div class="card event-card dark-grey mx-2 mb-4" style="width: 410px;">
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
            <?php else: ?>
                <div class="col-12 text-center text-white">
                    <p>No announcements found</p>
                </div>
            <?php endif; ?>
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