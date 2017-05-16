<?php
include ("Session.php");
    
$session->forgotPassword($_POST['username']);
?>