<?php 
include ("header.php");
if($_SESSION['loggedin']){
?>
    
<div class="container">
    
    <div class="row">
        
        <div class="col-lg-12 col-md-12 col-sm-12 mb-10 text-center">
            <h2>Choose Your GameMode</h2>
        </div>
        
        
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="well text-center">
                <a href="singleplayer.php">
                    <i class='fa fa-user' style="font-size: 300px;"></i>
                    <h3 class="mt-10">Singleplayer</h3>
                </a>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="well text-center">
                <a href="multiplayer.php">
                    <i class='fa fa-users' style="font-size: 300px;"></i>
                    <h3 class="mt-10">Multiplayer</h3>
                </a>
            </div>
        </div>
        
    </div>
</div>
        
<?php 

include ("footer.php");
} else {
    $_SESSION['alert'] = array("danger","Du skal være logget ind for at spille");
    header( "Location: index.php" );
    header( "HTTP/1.1 301 Moved Permanently" );
} ?>