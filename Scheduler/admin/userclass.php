<?php 
session_start();

if (!isset($_SESSION["userID"]) || $_SESSION["userClass"] > 2) {
    header("Location: https://scheduler.8thkg.team/");
    die();
}
include_once 'header.php';
?>
    <script src="javascript/userclass.js"></script>   
    <div class="container">
        <h2>Change User Class</h2>
        <p>Leader:</p>
        <p>Moderator:</p>
        <p>User:</p>     
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>UserID</th>
                    <th>Username</th>
                    <th>Class</th>
                    <th>Group</th>
                </tr>
            </thead>
            <tbody id="tablebody">   
            </tbody>
        </table>
    </div>

</body>
</html>