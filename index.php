<?php
include ("header.php");
    
?>
<div class="container">
    
    <?php
    if($_SESSION['loggedin']) {
        
        if(isset($_SESSION['alert'])){
    ?>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="alert alert-dismissible alert-<?php echo $_SESSION['alert'][0]; ?>">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class='fa fa-warning'></i> <?php echo $_SESSION['alert'][1]; ?>
        </div>
    </div>
    <?php
    unset($_SESSION['alert']);
    } else {
        echo '<div class="mt-70"></div>';
    }
    ?>
    
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="well text-center">
            <h3>We are proud to present</h3>
            <div class="hangman mb-5">HangAnimals</div>
            Made by Gruppe 16
                
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 mt-40 mb-10">
                    Try our new android application when you are on the run! Scan the QR-code and get the new application.
                </div>
                
                <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
                    <img src="images/hanganimalslogo.png" width="250">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <img src="images/qrcode.jpg" width="250">
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
        
    <?php
    } else {
        
        if(isset($_SESSION['alert'])){
        ?>
    <div class="col-lg-6 col-md-6 col-sm-12 col-lg-offset-3 col-md-offset-3">
        <div class="alert alert-dismissible alert-<?php echo $_SESSION['alert'][0]; ?>">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class='fa fa-warning'></i> <?php echo $_SESSION['alert'][1]; ?>
        </div>
    </div>
        <?php
        unset($_SESSION['alert']);
        } else {
            echo '<div class="mt-70"></div>';
        }
        ?>
            
    <div class="col-lg-6 col-md-6 col-sm-12 col-lg-offset-3 col-md-offset-3">
        <div class="well text-center">
            <form role="form" method="post" action="include/Login.php">
                <div class="form-signin">
                    <div class="hangman mb-5">HangAnimals</div>
                    <div class="mb-20">Gruppe 16</div>
                        
                        
                    <div class="input-group mt-10">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="">
                    </div>
                    <div class="input-group mt-10">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password" required="">
                    </div>
                    <input type="submit" class="btn btn-primary btn-block mt-10" id="login" value="Login">
                </div>
            </form>
            <div class="text-right"><a href="forgot.php">Forgot Password?</a></div>
        </div>
    </div>    
        
</div>

    <?php
}
include ("footer.php");
?>