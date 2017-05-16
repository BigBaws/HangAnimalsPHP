<?php 
include ("header.php");
    
if(!$_SESSION['loggedin']){
?>
    
<div class="container">
    
    <div class="col-lg-6 col-md-6 col-sm-12 col-lg-offset-3 col-md-offset-3">
        <div class="well text-center">
            <h3 class="mt-0 mb-15 text-center">Forgot your Password?</h3>
            Enter your username and you will get your password send to your email.
            
            <form role="form" method="post" action="include/ForgotPassword.php">
                <div class="input-group mt-10">
                    <span class="input-group-addon"> <i class="fa fa-user"></i> </span>
                    <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="">
                    <span class="input-group-btn">
                        <input type="submit" class="btn btn-default" value="Send Password">
                    </span>
                </div>
            </form>
                
            <div class="clearfix"></div>
        </div>
    </div>
        
        
</div>
<?php 
include ("footer.php");
} else {
    $_SESSION['alert'] = array("danger","Du er allerede logget ind");
    header( "Location: index.php" );
    header( "HTTP/1.1 301 Moved Permanently" );
}
?>