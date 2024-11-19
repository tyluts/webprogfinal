<?php
// FILE: include/db_queries.php

 require_once('config.php');

// Events queries
$eventsSql = "SELECT * FROM events ORDER BY date DESC LIMIT 3";
$eventsSqlResult = $con->query($eventsSql);

// News queries 
$news_sql = "SELECT * FROM posts ORDER BY date_posted ASC LIMIT 3";
$news_sql_result = $con->query($news_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php';  ?>
   
    <title>Home</title>
</head>

<body class="black">
    <?php include 'include/navigation.php' ?>
        <?php include 'home/video.php' ?>
        <?php include 'public_events.php' ?>
    <?php include 'public_news.php'; ?>
            <?php include 'home/modal.php'; ?>
            

        
    
        <div class="col container-fluid mt-5">
            <div  class="row">
                <h1  class="red montserrat fw-bold">
                    Top Programs
                </h1>
            </div>
            <div  class="row">
                <p  class="white hind">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                </p>
            </div>
            <?php include 'home/accordion.php'; ?>
        </div>
        <?php include 'include/footer.php'; ?>
</body>
</html>