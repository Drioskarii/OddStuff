<!DOCTYPE html>
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
            <a class="navbar-brand" href="/">Scheduler</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <?php
                            if (isset($_SESSION["userID"])){
                        ?>
                            <button type="button" data-toggle="modal" data-target="#createEvent" class="btn btn-lg btn-dark">Create Events</button>
                        <?php
                            }
                        ?>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto ml-2">
                        <li class="nav-item">
                            <!--If userClass = admin-->
                            <?php
                                    if (isset($_SESSION["userID"]) && $_SESSION["userClass"] <= 3) {
                                ?>
                                <a href="/admin/userclass" class="btn btn-lg btn-dark">Adminpage</a>
                                <a class="btn btn-lg btn-dark" name="logud" href="/api/login/logout">Log out</a>
                        </li>
                        <li class="nav-item">
                            <!--If userClass != user-->
                            <?php
                                    } elseif (isset($_SESSION["userID"]) && $_SESSION["userClass"] >= 4) {
                                ?>
                                <a class="btn btn-lg btn-dark" name="logud" href="/api/login/logout">Log out</a>
                        </li>
                        <li class="nav-item">
                            <!--Is guest-->
                            <?php
                                    } else {
                                ?>
                                <button type="button" data-toggle="modal" data-target="#modalLogin" class="btn btn-lg  btn-dark">Login</button>
                                <button type="button" data-toggle="modal" data-target="#modalRegister" class="btn btn-lg btn-dark">Register</button>
                                <?php
                                    } 
                                ?>
                        </li>
                    </ul>
                </form>

            </div>
        </nav>

        <!--Modal Login-->
        <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">>
            <div class="modal-dialog">
                <div class="modal-content modalbox">
                    <div class=" form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control responsivemodalsecondary" id="InputUsername" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" name="password" class="form-control responsivemodalsecondary" id="InputPassword" placeholder="Password">
                    </div>
                    <button type="submit" onclick="login()" class="btn btn-primary">Login</button>
                </div>
            </div>
        </div>

        <!---->

        <!--Modal register-->
        <div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="Register" aria-hidden="true">>
            <div class="modal-dialog">
                <div class="modal-content modalbox">
                    <div class=" form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control responsivemodalsecondary" id="registerUsername" placeholder="Username">
                    </div>
                    <div class=" form-group">
                        <label for="Email">Email address</label>
                        <input type="text" name="Email" class="form-control responsivemodalsecondary" id="registerEmail" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" name="password" class="form-control responsivemodalsecondary" id="registerPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Confirm Password</label>
                        <input type="password" name="confirmPassword" class="form-control responsivemodalsecondary" id="registerPassword1" placeholder="Password">
                    </div>
                    <button onclick="createUser()" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!---->

    <!--Modal create event-->
    <div class="modal fade" id="createEvent" tabindex="-1" role="dialog" aria-labelledby="eventCreate" aria-hidden="true">>
            <div class="modal-dialog">
                <div class="modal-content modalbox">

                    <div class=" form-group">
                        <label for="eventName">Event Name</label>
                        <input type="text" name="eventName" class="form-control responsivemodalsecondary" id="registerEventName" placeholder="Coffe fest">
                    </div>
                    <div class=" form-group">
                        <label for="eventStart">Event Start</label>
                        <input type="date" name="eventStart" class="form-control responsivemodalsecondary" id="registerEventStart" placeholder="eventStart">
                    </div>
                    <div class="form-group">
                        <label for="eventStop">Time</label>
                        <input type="time" name="eventStop" class="form-control responsivemodalsecondary" id="registerEventStop" placeholder="eventStop">
                    </div>
                    <div class="form-group">
                        <label for="eventDescription">Event Description</label>
                        <textarea type="text"  rows ="4" cols="50" name="eventDescription" class="form-control responsivemodalsecondary" id="registerEventDescription" placeholder="Write your Description"></textarea>
                    </div>
                    <button onclick="createNewEvent()" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>
    <!---->