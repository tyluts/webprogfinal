<?php
// Update the path to point to the correct location of config.php
//require_once('../../config.php');  // Assuming config.php is in the root directory

$sql = "SELECT * FROM social_section WHERE ID = 1";
$result = $con->query($sql);
?>

<?php while($row = $result->fetch_assoc()): ?>
<div class="position-relative w-100 my-5" style="height: 30vh;">
   <img src="<?php echo !empty($row['social_image']) ? '../../admin/' . $row['social_image'] : '../../img/frosh.jpg'; ?>"
         class="img-fluid w-100" 
         alt="<?php echo htmlspecialchars($row['social_title']); ?>" 
         style="height: 100%; object-fit: cover;">
    <div class="dark-mask position-absolute top-0 start-0 w-100 h-100"></div>
    <div class="content-overlay position-absolute top-50 start-50 translate-middle text-center text-white">
        <h2 class="mb-2"><?php echo htmlspecialchars($row['social_title']); ?></h2>
        <p class="mb-3"><?php echo htmlspecialchars($row['social_desc']); ?></p>
        <a href="https://facebook.com" target="_blank" class="text-white">
            <i class="<?php echo htmlspecialchars($row['social_icon']); ?> fa-2x"></i>
        </a>
    </div>
</div>
<?php endwhile; ?>

<style>
.dark-mask {
  background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent dark mask */
}

.content-overlay {
  z-index: 2; /* Ensure the overlay content appears above the dark mask */
}
</style>

