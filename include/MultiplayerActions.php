<?php
include ("Multiplayer.php");
include ("Session.php");

if(isset($_POST['createRoom'])){
    $multiplayer->createRoom($_SESSION['token']);
}

else if(isset($_POST['join'])){
    $multiplayer->joinRoom($_POST['roomid'], $_SESSION['token'], $_SESSION['userid']);
}

else if(isset($_POST['leave'])){
    $multiplayer->leaveRoom($_POST['roomid'], $_SESSION['token'], $_SESSION['userid']);
}

else if(isset($_POST['guess'])){
    echo $multiplayer->guess($_POST['roomid'], $_SESSION['token'], $_SESSION['userid'], $_POST['letter']);
}

else if(isset($_POST['nextRound'])) {
    $multiplayer->nextRound( $_POST['roomid'], $_POST['userid'] );
}
else {
    header("Location: multiplayer.php?noaction");
}
            
?>