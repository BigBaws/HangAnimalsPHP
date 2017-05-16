<?php 
include ("header.php");
if($_SESSION['loggedin']){
?>
    
<div class="container">
    
    <div class="row">
        
        
        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
            <div class="well text-center">
                <h2>Choose Animal</h2>
                    
                <div class="col-lg-6 col-md-6 col-sm-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 text-center">
                    <p id="showAnimal"></p>
                </div>
                    
                <div class="col-lg-6 col-md-6 col-sm-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 text-center">
                    <select class="form-control" id="changeanimal" onchange="changeAnimal()">
                        <option value="bunny">Bunny</option>
                        <option value="sheep">Sheep</option>
                        <option value="dragon">Dragon</option>
                    </select>
                    
                    <select class="form-control" id="changecolor" onchange="changeAnimal()">
                        <option value="blue">Blue</option>
                        <option value="pink">Pink</option>
                        <option value="green">Green</option>
                        <option value="white">White</option>
                        <option value="black">Black</option>
                    </select>
                    
                    <input type="submit" class="btn btn-primary btn-block mt-10" value="Save Animal">
                </div>
                
                <div class="clearfix"></div>
                    
            </div>
        </div>
            
    </div>
</div>

<script>
function changeAnimal() {
    var animal = document.getElementById("changeanimal").value;
    var color = document.getElementById("changecolor").value;
    document.getElementById("showAnimal").innerHTML = "<img src='images/animals/"+animal+"_"+color+".PNG' width='250'>";
}
changeAnimal();
</script>


<?php 
include ("footer.php");
} else {
	$_SESSION['alert'] = array("danger","Du skal være logget ind for at spille");
	header( "Location: index.php" );
	header( "HTTP/1.1 301 Moved Permanently" );
} ?>