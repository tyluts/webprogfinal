<?php
require_once 'config.php';

// Fetch vision section data
$query = "SELECT vision_title, vision_desc, vision_image FROM aboutus_section WHERE id = 1";
$result = mysqli_query($con, $query);
$vision = mysqli_fetch_assoc($result);

// Set default values if no data found
if (!$vision) {
    $vision = [
        'vision_title' => 'Our Vision',
        'vision_desc' => 'Default vision description',
        'vision_image' => 'img/frosh.jpg'
    ];
}
?>

<section class="my-5 py-5">
    <div class="container my-4">
        <div class="row align-items-center">
            <div class="col-md-4 mb-3 mb-md-0">
                <img src="admin/<?php echo htmlspecialchars($vision['vision_image']); ?>" 
                     alt="Vision Image" 
                     class="img-fluid rounded-pill">
            </div>
            <div class="col-md-8 text-end">
                <h2 class="montserrat red fs-1 fw-bold">
                    <?php echo htmlspecialchars($vision['vision_title']); ?>
                </h2>
                <p class="hind white">
                    <?php echo htmlspecialchars($vision['vision_desc']); ?>
                </p>
            </div>
        </div>
    </div>
</section>