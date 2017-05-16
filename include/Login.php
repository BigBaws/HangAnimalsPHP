<?php
include ("Session.php");
    
$session->login($_POST['username'], $_POST['password']);
?>