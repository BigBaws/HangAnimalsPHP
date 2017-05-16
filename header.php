<?php
header('Content-type: text/html; charset=UTF-8');
include ("include/Session.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>HangAnimals</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/margin-padding.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        
        <link href="favicon.ico" rel="icon">
        <script src="js/jquery-1.10.2.min.js"></script>

    </head>
    
    <body>
        
        <?php
        if(!empty($_SESSION['loggedin'])) {
        ?>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Gruppe16</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="hanganimals.php">HangAnimals</a></li>
                        <li><a href="chat.php">Chat</a></li>
                        <li><a href="highscore.php">Highscore</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <?php echo $_SESSION['name'] ?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="profile.php">Profile</a></li>
                                <li><a href="changeanimal.php">Change Animal</a></li>
                                <li><a href="#">Friends</a></li>
                                <li><a href="#">Challenges</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <?php
        } else {
        ?>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Gruppe16</a>
                </div>
            </div>
        </nav>
        <?php } ?>
