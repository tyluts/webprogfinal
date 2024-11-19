<?php
// FILE: include/db_queries.php

require_once(__DIR__ . '/../config.php');

// Events queries
$eventsSql = "SELECT * FROM events ORDER BY date DESC LIMIT 3";
$eventsSqlResult = $con->query($eventsSql);

// News queries 
$news_sql = "SELECT * FROM posts ORDER BY date_posted ASC LIMIT 3";
$news_sql_result = $con->query($news_sql);
?>