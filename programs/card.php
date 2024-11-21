<?php
require_once('config.php');


function getProgramsByRange($con, $startId, $endId) {
    $sql = "SELECT * FROM department_programs WHERE id BETWEEN ? AND ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $startId, $endId);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>

<style>
.carousel-outer-controls {
    position: relative;
    padding: 0 30px;
}

.carousel-outer-controls .carousel-control-prev,
.carousel-outer-controls .carousel-control-next {
    width: 30px;
    background-color: rgba(0,0,0,0.5);
    border-radius: 50%;
    height: 30px;
    top: 50%;
    transform: translateY(-50%);
}

.carousel-outer-controls .carousel-control-prev {
    left: -5px;
}

.carousel-outer-controls .carousel-control-next {
    right: -5px;
}

.program-card {
    max-width: 400px;
    margin: 0 auto;
}

.card-body {
    overflow: hidden;
}

.card-title {
    font-size: 1.5rem;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.card-img-top {
    width: 100%;
    min-height: 300px; /* Fixed height for consistency */
    object-fit: cover;
    object-position: center;
    border-radius: 18px;
}

/* Ensure overlay matches image size */
.position-relative .position-absolute {
    height: 300px;
}
</style>

<div class="container-fluid mt-4 mb-5">
    <div class="row justify-content-center">
        <?php
        // First Column (IDs 1-2)
        $firstColumn = getProgramsByRange($con, 1, 2);
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div id="carouselExampleCaptions1" class="carousel slide carousel-outer-controls" data-bs-ride="carousel">
                <div class="carousel-inner mx-auto" style="border-radius: 18px;">
                    <?php foreach($firstColumn as $index => $program) { ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?> position-relative">
                            <div class="card dark-grey white program-card">
                                <h1 class="text-center fs-5 p-2 text-white position-relative">
                                    <?php echo htmlspecialchars($program['department_title']); ?>
                                </h1>
                                <div class="position-relative">
                                    <img src="admin/<?php echo !empty($program['department_image']) ? 
                                        htmlspecialchars($program['department_image']) : 'img/frosh.jpg'; ?>" 
                                        class="card-img-top" alt="Department Image"
                                        style="height: 350px !important; width: 100%; object-fit: cover; border-radius: 18px;">
                                    <div class="position-absolute top-0 start-0 w-100 h-100" 
                                         style="background-color: rgba(0, 0, 0, 0.7); border-radius: 18px;">
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <h5 class="card-title mb-2 text-white">
                                        <?php echo htmlspecialchars($program['course_title']); ?>
                                    </h5>
                                    <a href="" class="btn bg-red text-white">
                                        <?php echo htmlspecialchars($program['button_text']); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <?php
        // Second Column (IDs 3-4)
        $secondColumn = getProgramsByRange($con, 3, 4);
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div id="carouselExampleCaptions2" class="carousel slide carousel-outer-controls" data-bs-ride="carousel">
                <div class="carousel-inner mx-auto" style="border-radius: 18px;">
                    <?php foreach($secondColumn as $index => $program) { ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?> position-relative">
                            <div class="card dark-grey white program-card">
                                <h1 class="text-center fs-5 p-2 text-white position-relative">
                                    <?php echo htmlspecialchars($program['department_title']); ?>
                                </h1>
                                <div class="position-relative">
                                    <img src="admin/<?php echo !empty($program['department_image']) ? 
                                        htmlspecialchars($program['department_image']) : 'img/frosh.jpg'; ?>" 
                                        class="card-img-top" alt="Department Image" 
                                        style="height: 350px !important; width: 100%; object-fit: cover; border-radius: 18px;">
                                    <div class="position-absolute top-0 start-0 w-100 h-100" 
                                        style="background-color: rgba(0, 0, 0, 0.7); border-radius: 18px;">
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <h5 class="card-title mb-2 text-white">
                                        <?php echo htmlspecialchars($program['course_title']); ?>
                                    </h5>
                                    <!-- For second column (IDs 3-4) update button to: -->
                                    <a href="<?php echo $program['id'] == 3 ? 'programs/ccs/it.php' : 'programs/ccs/act.php'; ?>" class="btn bg-red text-white">
                                        <?php echo htmlspecialchars($program['button_text']); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions2" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions2" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <?php
        // Third Column (IDs 5-6)
        $thirdColumn = getProgramsByRange($con, 7, 11);
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div id="carouselExampleCaptions3" class="carousel slide carousel-outer-controls" data-bs-ride="carousel">
                <div class="carousel-inner mx-auto" style="border-radius: 18px;">
                    <?php foreach($thirdColumn as $index => $program) { ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?> position-relative">
                            <div class="card dark-grey white program-card">
                                <h1 class="text-center fs-5 p-2 text-white position-relative">
                                    <?php echo htmlspecialchars($program['department_title']); ?>
                                </h1>
                                <div class="position-relative">
                                    <img src="admin/<?php echo !empty($program['department_image']) ? 
                                        htmlspecialchars($program['department_image']) : 'img/frosh.jpg'; ?>" 
                                        class="card-img-top" alt="Department Image"
                                        style="height: 350px !important; width: 100%; object-fit: cover; border-radius: 18px;">
                                    <div class="position-absolute top-0 start-0 w-100 h-100" 
                                         style="background-color: rgba(0, 0, 0, 0.7); border-radius: 18px;">
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <h5 class="card-title mb-2 text-white">
                                        <?php echo htmlspecialchars($program['course_title']); ?>
                                    </h5>
                                    <a href="./programs/coursepage.php?course_code=<?php echo urlencode(trim($program['course_code'])); ?>" class="btn bg-red text-white">
                                        <?php echo htmlspecialchars($program['button_text']); ?>
                                    </a>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>