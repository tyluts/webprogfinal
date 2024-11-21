<?php
// Include database connection
require_once 'config.php';

// Fetch hero section data - getting the first record
$query = "SELECT * FROM hero_section WHERE id = 2";
$result = mysqli_query($con, $query);
$hero = mysqli_fetch_assoc($result);

// If no data found, set default values
if (!$hero) {
    $hero = [
        'hero_img' => 'img/hero/campus1.jpg',
        'hero_title' => 'Welcome to Our University',
        'hero_desc' => 'Empowering minds, shaping futures. Join our community of innovative learners and world-class educators.',
        'button_text' => 'Learn More'
    ];
}
?>

<div class="container-fluid mt-4">
    <div class="row justify-content-center no-gutters">
        <div class="col-12">
            <div class="position-relative overflow-hidden" 
                 style="height: 50vh; min-height: 300px; max-height: 500px;">
                <img src="admin/<?php echo htmlspecialchars($hero['hero_img']); ?>"
                     alt="<?php echo htmlspecialchars($hero['hero_title']); ?>"
                     class="embed-responsive-item w-100 h-100"
                     style="object-fit: cover;"
                />
                <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" 
                     style="background-color: rgba(0, 0, 0, 0.5);">
                    <div class="text-center text-white p-2 p-md-3">
                        <h2 class="fw-bold  fs-sm-4 fs-md-3 red"><?php echo htmlspecialchars($hero['hero_title']); ?></h2>
                        <p class="fs-7 fs-sm-6 fs-md-5 mb-2 mb-md-3">
                            <?php echo htmlspecialchars($hero['hero_desc']); ?>
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>