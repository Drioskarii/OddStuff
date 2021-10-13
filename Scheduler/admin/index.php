<?php 
session_start();

if (!isset($_SESSION["userID"]) || $_SESSION["userClass"] > 3) {
    header("Location: https://scheduler.8thkg.team/");
    die();
}
include_once 'header.php';
?>

    

    </body>
</html>