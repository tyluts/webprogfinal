<?php
    $top_programs_sql = "SELECT * FROM top_programs";
    $top_programs_result = $con->query($top_programs_sql);
?>

<div class="col container-fluid mt-4 mb-5 ">
    <div class="row ">
        <div class="accordion mb-5" id="accordionExample">
            <?php while($res = mysqli_fetch_assoc($top_programs_result)) { ?>
                <div class="accordion-item dark-grey light-grey">
                    <input type="hidden" value="<?php echo $res['id']; ?>">
                    <h2 class="accordion-header">
                        <button class="accordion-button bg-dark text-white montserrat" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#collapse<?php echo $res['id']; ?>" 
                                aria-expanded="false" 
                                aria-controls="collapse<?php echo $res['id']; ?>">
                            <?php echo $res['title']; ?>
                        </button>
                    </h2>
                    <div id="collapse<?php echo $res['id']; ?>" 
                        class="accordion-collapse collapse" 
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body text-white">
                            <?php echo $res['description']; ?>
                            <br>
                            <a href="<?php echo $res['page_url']?>" class="btn bg-red text-white mt-2">Click Me</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>


