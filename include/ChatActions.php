<?php
include ("Chat.php");
include ("Session.php");

if(isset($_POST['send'])){
    $chat->sendMessage($_SESSION['token'], $_SESSION['userid'], $_POST['message']);
}

else {
    header("Location: chat.php?Fail=chatactions");
}
            
?>