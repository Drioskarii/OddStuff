<html>
    <head>
        <title>Scheduler</title>
        <!-- Latest compiled and minified CSS -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css">
        <script src="javascript.js"></script>
    </head>
    <body>
        <div class="bd-example">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="https://scheduler.8thkg.team/admin/userclass">Admin Page</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav mr-auto">
                    <?php    
                    switch($_SESSION["userClass"]) {
                        case 1:
                        case 2:
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="userclass">Change user class</a>
                        </li>
                    <?php
                    break;

                    }
                    ?>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <ul class="navbar-nav mr-auto ml-2">
                            <li class="nav-item">
                                <a class="btn btn-lg btn-dark" href="https://scheduler.8thkg.team/">Frontpage</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-lg btn-dark" href="https://scheduler.8thkg.team/api/login/logout">Log out</a>
                            </li>
                        </ul>
                    </form>
                
                </div>
            </nav>