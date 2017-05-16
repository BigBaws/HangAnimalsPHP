<?php
include ("Singleplayer.php");
include ("Session.php");

if(isset($_POST['create'])){
    $singleplayer->create($_SESSION['token'], $_SESSION['userid'], $_POST['singleplayer']);
}

else if(isset($_POST['leave'])){
    $singleplayer->leave($_SESSION['token'], $_SESSION['userid'], $_POST['singleplayer']);
}

else if(isset($_POST['guess'])){
    echo $singleplayer->guess($_SESSION['token'], $_SESSION['userid'], $_SESSION['singleplayer'], $_POST['letter']);
}

else {
    header("Location: singleplayer.php?noaction");
}
            
?>