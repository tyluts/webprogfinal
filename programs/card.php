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
.program-card {
    max-width: 100%;
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
    min-height: 200px; /* Fixed height for consistency */
    object-fit: cover;
    object-position: center;
    border-radius: 0;
   
}

/* Ensure overlay matches image size */
.position-relative .position-absolute {
    height: 300px;
}
</style>

<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <?php
        // First Column (IDs 1-2)
        $firstColumn = getProgramsByRange($con, 1, 2);
        foreach($firstColumn as $program) { ?>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card dark-grey red program-card">
                    <h1 class="text-center fs-3  p-2 text-white position-relative ">
                        <?php echo htmlspecialchars($program['department_title']); ?>
                    </h1>
                    <div class="position-relative">
                        <img src="admin/<?php echo !empty($program['department_image']) ? 
                            htmlspecialchars($program['department_image']) : 'img/frosh.jpg'; ?>" 
                            class="card-img-top" alt="Department Image"
                            style="height: 350px !important; width: 100%; object-fit: cover; ">
                        <div class="position-absolute top-0 start-0 w-100 h-100" 
                             style="background-color: rgba(0, 0, 0, 0.7); ">
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <h5 class="card-title mb-2 text-white  ">
                            <?php echo htmlspecialchars($program['course_title']); ?>
                        </h5>
                        <a href="" class="btn bg-red text-white">
                            <?php echo htmlspecialchars($program['button_text']); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php
        // Second Column (IDs 3-4)
        $secondColumn = getProgramsByRange($con, 3, 4);
        foreach($secondColumn as $program) { ?>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card dark-grey white program-card">
                    <h1 class="text-center fs-3 p-2  position-relative ">
                        <?php echo htmlspecialchars($program['department_title']); ?>
                    </h1>
                    <div class="position-relative">
                        <img src="admin/<?php echo !empty($program['department_image']) ? 
                            htmlspecialchars($program['department_image']) : 'img/frosh.jpg'; ?>" 
                            class="card-img-top" alt="Department Image" 
                            style="height: 350px !important; width: 100%; object-fit: cover; ">
                        <div class="position-absolute top-0 start-0 w-100 h-100" 
                            style="background-color: rgba(0, 0, 0, 0.7); ">
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <h5 class="card-title mb-2 text-white">
                            <?php echo htmlspecialchars($program['course_title']); ?>
                        </h5>
                        <a href="<?php echo $program['id'] == 3 ? 'programs/ccs/it.php' : 'programs/ccs/act.php'; ?>" class="btn bg-red text-white">
                            <?php echo htmlspecialchars($program['button_text']); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php
        // Third Column (IDs 5-6)
        $thirdColumn = getProgramsByRange($con, 7, 11);
        foreach($thirdColumn as $program) { ?>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card dark-grey white program-card">
                    <h1 class="text-center fs-3 p-2 text-white position-relative red">
                        <?php echo htmlspecialchars($program['department_title']); ?>
                    </h1>
                    <div class="position-relative">
                        <img src="admin/<?php echo !empty($program['department_image']) ? 
                            htmlspecialchars($program['department_image']) : 'img/frosh.jpg'; ?>" 
                            class="card-img-top" alt="Department Image"
                            style="height: 350px !important; width: 100%; object-fit: cover; ">
                        <div class="position-absolute top-0 start-0 w-100 h-100" 
                             style="background-color: rgba(0, 0, 0, 0.7); ">
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
</div>