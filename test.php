<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php'; ?>
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    /* Remove padding and margin for the container, row, and columns */
    .no-margin-container, .no-margin-row, .no-margin-col {
      padding: 0;
      margin: 0;
    }
    
    /* Ensures images fit the columns perfectly with no gaps */
    .no-margin-row .col-2 {
      padding: 0;
    }

    /* Make images responsive and remove spacing */
    .no-margin-row img {
      width: 100%;
      height: auto;
      display: block; /* Prevents gaps from inline-block spacing */
    }
  </style>
</head>
<body class="black">

<div class="container-fluid no-margin-container">
  <div class="row no-margin-row">
    <!-- Each column will take 1/5 of the row (close to 12 / 5 columns) -->
    <div class="col-2 no-margin-col">
      <img src="img/frosh.jpg" alt="Image 1" class="img-fluid">
    </div>
    <div class="col-2 no-margin-col">
      <img src="img/frosh.jpg" alt="Image 2" class="img-fluid">
    </div>
    <div class="col-2 no-margin-col">
      <img src="img/frosh.jpg" alt="Image 3" class="img-fluid">
    </div>
    <div class="col-2 no-margin-col">
      <img src="img/frosh.jpg" alt="Image 4" class="img-fluid">
    </div>
    <div class="col-2 no-margin-col">
      <img src="img/frosh.jpg" alt="Image 5" class="img-fluid">
    </div>
        <div class="col-2 no-margin-col">
      <img src="img/frosh.jpg" alt="Image 5" class="img-fluid">
    </div>
  </div>
</div>



<!-- Custom CSS for larger modal size and larger image size -->




</body>
</html>

