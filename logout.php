<?php
session_start();
session_unset();
$_SESSION['alert'] = array("success","Du er nu logget ud");
Header( "Location: index.php" );
Header( "HTTP/1.1 301 Moved Permanently" );
?>