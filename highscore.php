<?php 
include ("header.php");
    
if($_SESSION['loggedin']){
?>
    
<div class="container">
    
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="well">
            <h3 class="mt-0 mb-0 text-center">Highscore <small>(Top 10)</small></h3>
            <h3 class="mb-15 text-center" style="margin-top: -5px"><small>Singleplayer</small></h3>
                
            <div class="col-lg-12 col-md-12 col-sm-12 mb-15">
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-1">
                        <h4>1.</h4>
                    </div>
                        
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <img src="<?php echo $_SESSION['image']; ?>" class="alignleft img-circle img-thumbnail" style="margin-top: -10px; height: 40px; width: 40px;">
                    </div>
                        
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h4><?php echo $_SESSION['name']; ?></h4>
                    </div>
                        
                    <div class="col-lg-3 col-md-3 col-sm-3 text-right">
                        <h4>1500 Points</h4>
                    </div>
                </div>
            </div>
                
            <div class="clearfix"></div>
                
                
            <div class="col-lg-12 col-md-12 col-sm-12 mb-15">
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-1">
                        <h4>2.</h4>
                    </div>
                        
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <img src="<?php echo $_SESSION['image']; ?>" class="alignleft img-circle img-thumbnail" style="margin-top: -10px; height: 40px; width: 40px;">
                    </div>
                        
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h4><?php echo $_SESSION['name']; ?></h4>
                    </div>
                        
                    <div class="col-lg-3 col-md-3 col-sm-3 text-right">
                        <h4>1400 Points</h4>
                    </div>
                </div>
            </div>
                
                
            <div class="clearfix"></div>
                
        </div>
    </div>
        
        
        
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="well">
            <h3 class="mt-0 mb-0 text-center">Highscore <small>(Top 10)</small></h3>
            <h3 class="mt-0 mb-0 text-center"><small>Multiplayer</small></h3>
                
            <div class="col-lg-1 col-md-1 col-sm-1">
                <h4>1.</h4>
            </div>
                
            <div class="col-lg-2 col-md-2 col-sm-2">
                <img src="<?php echo $_SESSION['image']; ?>" class="alignleft img-circle img-thumbnail mt-10" style="height: 40px; width: 40px;">
            </div>
                
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h4><?php echo $_SESSION['name']; ?></h4>
            </div>
                
            <div class="col-lg-3 col-md-3 col-sm-3 text-right">
                <h4>1500 Points</h4>
            </div>
                
            <div class="clearfix"></div>
                
        </div>
    </div>
        
        
</div>
<?php 
include ("footer.php");
} else {
    $_SESSION['alert'] = array("danger","Du skal være logget ind for at spille");
    header( "Location: index.php" );
    header( "HTTP/1.1 301 Moved Permanently" );
}
?>