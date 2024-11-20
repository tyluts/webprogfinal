<?php
require_once 'config.php';

// Fetch mission section data
$query = "SELECT mission_title, mission_desc, mission_image FROM aboutus_section WHERE id = 1";
$result = mysqli_query($con, $query);
$mission = mysqli_fetch_assoc($result);

// Set default values if no data found
if (!$mission) {
    $mission = [
        'mission_title' => 'Our Mission',
        'mission_desc' => 'Default mission description',
        'mission_image' => 'img/frosh.jpg'
    ];
}
?>

<section class="my-5 py-5">
    <div class="container my-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="montserrat red fs-1 fw-bold"><?php echo htmlspecialchars($mission['mission_title']); ?></h2>
                <p class="hind white"><?php echo htmlspecialchars($mission['mission_desc']); ?></p>
            </div>
            <div class="col-md-4">
                <img src="admin/<?php echo htmlspecialchars($mission['mission_image']); ?>" 
                     alt="Mission Image" 
                     class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>