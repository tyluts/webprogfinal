<?php
session_start();
require_once('config.php');


if (isset($_POST['click_deets'])) {
    $id = intval($_POST['user_id']);
    
    $stmt = $con->prepare("SELECT * FROM events WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $eventsSqlResult = $stmt->get_result();

    if ($eventsSqlResult->num_rows > 0) {
        while ($row = $eventsSqlResult->fetch_assoc()) {
            echo '
                <div class="modal-header d-flex justify-content-center w-100" style="background-color: #13171a; border-bottom: 1px solid #343a40;">
                    <h5 class="modal-title"><strong>' . htmlspecialchars($row['title']) . '</strong></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-white">
                    <div class="card mb-3" style="background-color: #23282b; color: #ffffff; border: 1px solid #343a40;">
                        <img src="./admin/' . htmlspecialchars($row['img']) . '" alt="Event Image" class="card-img-top img-fluid" style="border-bottom: 1px solid #343a40;" />
                        <div class="card-body">
                            <p class="card-text"><strong>Description:</strong> ' . htmlspecialchars($row['description']) . '</p>
                            <p class="card-text"><strong>Date:</strong> ' . htmlspecialchars($row['date']) . '</p>
                            <p class="card-text"><strong>Location:</strong> ' . htmlspecialchars($row['loc']) . '</p>
                        </div>
                    </div>
                </div>
            ';
        }
    } else {
        echo '<p class="text-center text-muted" style="color: #868e96;">No announcements found</p>';
    }

    // Close the statement
    $stmt->close();
}




if (isset($_POST['news_deets'])) {
    $id = intval($_POST['news_id']);
    
    $stmt = $con->prepare("SELECT * FROM posts WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $eventsSqlResult = $stmt->get_result();

    if ($eventsSqlResult->num_rows > 0) {
        while ($row = $eventsSqlResult->fetch_assoc()) {
            echo '
                <div class="modal-header modal-header d-flex justify-content-center w-100" style="background-color: #13171a; border-bottom: 1px solid #343a40;">
                    <h5 class="modal-title"><strong>' . htmlspecialchars($row['title']) . '</strong> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-white">
                     <div class="card mb-3" style="background-color: #23282b; color: #ffffff; border: 1px solid #343a40;">
                        <img src="./admin/' . htmlspecialchars($row['photo']) . '" alt="News Image" class="card-img-top img-fluid" style="border-bottom: 1px solid #343a40;" />
                        <div class="card-body">
                            
                            <p class="card-text"><strong>Description:</strong> ' . htmlspecialchars($row['caption']) . '</p>
                            <p class="card-text"><strong>Date:</strong> ' . htmlspecialchars($row['date_posted']) . '</p>
                        </div>
                    </div>
                </div>

            ';
        }
    } else {
        echo '<p class="text-center text-muted" style="color: #868e96;">No news found</p>';
    }

    // Close the statement
    $stmt->close();
}


?>
