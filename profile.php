<?php 
include ("header.php");
    
if($_SESSION['loggedin']){
?>

<div class="container">
    

    <div class="col-lg-8 col-md-8 col-sm-8 well">
        
        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
            <img src="<?php echo $_SESSION['image']; ?>">
            Studie nummer
            <h4 class='mt-0'><?php echo $_SESSION['userid']; ?></h4>
        </div>
            
        <div class="col-lg-2 col-md-2 col-sm-4">
            <h4>Name:</h4>
            <h4>Token:</h4>
            <h4>Study:</h4>
            <h4>Currency:</h4>
            <h4>DTU Link:</h4>
            
            <br><br>
            
            <h4>Animal:</h4>
            <h4>AnimalColor:</h4>
            <h4>Singleplayer:</h4>
            <h4>Multiplayer:</h4>
        </div>
            
        <div class="col-lg-6 col-md-6 col-sm-4">
            <h4><?php echo $_SESSION['name']; ?></h4>
            <h4><?php echo $_SESSION['token']; ?></h4>
            <h4><?php if (!empty($_SESSION['study'])) { echo $_SESSION['study']; } else { echo "?"; } ?></h4>
            <h4><?php echo $_SESSION['currency']; ?></h4>
            <h4><a href="<?php echo $_SESSION['link']; ?>">DTU Profile</a></h4>
            
            <br><br>
            
            <h4><?php echo $_SESSION['animal']; ?></h4>
            <h4><?php echo $_SESSION['animalcolor']; ?></h4>
            <h4><?php echo $_SESSION['singleplayer']; ?></h4>
            <h4><?php echo $_SESSION['multiplayer']; ?></h4>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="well">
            <h3 class="mt-0">Highscore:</h3>
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