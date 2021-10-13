<?php
session_start();
include_once 'header.php';
include_once '../conn.php';
?>
<div class="card-deck">
<?php

//here is conn info ment to be :)
$servername = '167.99.129.18';
$username = 'general';
$password = 'kagekage';
$dbname = '8thKG';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM events";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        Echo "<div class='col-3 mt-2'>";
        Echo "<div class='card m-1 h-100 border-secondary'>";
        Echo    "<img class='card-img-top img-fluid' src='/img/tonk.jpg' alt='Card image cap' style='width: 100%'>";
        Echo   "<div class='card-body'>";
        Echo       "<h5 class='card-title'>". $row["eventName"]. " </h5>";
        Echo      "<p class='card-text'>". $row["description"]."</p>";
        Echo     "<div class='row'>";

        //Echo         "<div class='col-6'>";
        //Echo             "<a href='#' class='btn btn-primary float-left p-1'>Sign up/Leave</a>";
        //Echo         "</div>";

        //Echo        " <div class='col-6'>";
        //Echo               "<a href='#' class='card-link float-right p-1'>More information</a>";
        //Echo        " </div>";

        Echo           "<div class='col-6'>";
        Echo                "<p class='card-text'><small class='text-muted'>Event Created: ". $row["eventcreated"]."</small></p>";
        Echo             "</div>";
        Echo           "<div class='col-6'>";
        Echo                "<p class='card-text'><small class='text-muted'>Event Start: ". $row["eventstart"]."</small></p>";
        Echo                "<p class='card-text'><small class='text-muted'>Event Starts at: ". $row["eventstop"]."</small></p>";
        Echo             "</div>";
        Echo            "</div>";
        Echo        "</div>";
        Echo    "</div>";
        Echo "</div>";
        
    }
} else {
    echo "0 results";
}
$conn->close();
?> 
</div>
        </body>
    <?php
    include_once 'footer.php';
    ?>
    </html>