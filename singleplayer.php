<?php 
include ("header.php");
include ("include/Singleplayer.php");

if($_SESSION['loggedin']){
    $singleplayer = new Singleplayer();
    $game = $singleplayer->create($_SESSION['token'], $_SESSION['userid'], $_SESSION['singleplayer']);
    
    $usedletters = array(
    );
    $alphabet = array(
        "a", "b", "c", "d", "e", "f", "g",
        "h", "i", "j", "k", "l", "m", "n",
        "o", "p", "q", "r", "s", "t", "u",
        "v", "w", "x", "y", "z"
        );
    print_r($game);
?>

<div class="container">
    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-5">
            <h3>HangAnimals <small>(Singleplayer)</small></h3>
        </div>
            
        <div class="col-lg-9 col-md-9 col-sm-9">
            <div class="well">
                <div class="col-lg-7 col-md-7 col-sm-7 text-center">
                    <img src="images/hangman.png" height="400">
                        
                    <img src="images/animals/bunny_blue_head.PNG" class="hidden absolute" id="animal1" height="200">
                    <img src="images/animals/bunny_blue_armleft.PNG" class="hidden absolute" id="animal2" height="200">
                    <img src="images/animals/bunny_blue_armright.PNG" class="hidden absolute" id="animal3" height="200">
                    <img src="images/animals/bunny_blue_stomach.PNG" class="hidden absolute" id="animal4" height="200">
                    <img src="images/animals/bunny_blue_legleft.PNG" class="hidden absolute" id="animal5" height="200">
                    <img src="images/animals/bunny_blue_legright.PNG" class="hidden absolute" id="animal6" height="200">
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 mt-70 text-center">
                    You need to guess this word:<br>
                    <h3 id="userword"><?php echo $game->word; ?></h3>
                    <br><br>
                    OR I will hang your animal...muhahahahhahaha<br>
                    hahahahaahahahahahahahahahhaahhahahaha
                    
                    <img src="images/death.png" style="margin-top: 50px" height="180">
                </div>
                <div class="clearfix"></div>
            </div>
                
        </div>
            
        <div class="col-lg-3 col-md-3 col-sm-3">
            
            <div class="well">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <h3><?php echo $_SESSION['userid']; ?></h3>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Combo
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                        <span id="combo"><?php echo $game->combo; ?></span>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Wrongs
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                        <span id="wrongs">0</span>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Gamescore
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                        <span id="gamescore"><?php echo $game->gamescore; ?></span>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Time
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                        <span id="time">?</span>
                    </div>
                </div>
            </div>
            
            <div class="clearfix"></div>
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <form role="form" method="post" action="include/SingleplayerActions.php">
                        <input type="hidden" name="singleplayer" value="<?php echo $_SESSION['singleplayer']; ?>">
                        <input type="hidden" name="leave" value="1">
                        <input type="submit" class="btn btn-primary btn-sm btn-block" id="leave" value="Leave">
                    </form>
                </div>
                
                <div class="col-lg-12 col-md-12 col-sm-12 hidden" id="newgame">
                    <form role="form" method="post" action="include/SingleplayerActions.php">
                        <input type="hidden" name="singleplayer" value="<?php echo $_SESSION['singleplayer']; ?>">
                        <input type="hidden" name="leave" value="1">
                        <input type="submit" class="btn btn-primary btn-sm btn-block" id="leave" value="New Game">
                    </form>
                </div>
            </div>
            
            
        </div>
            
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="well" style="min-height: 80px;">
                <?php
                foreach ($alphabet as $a) {
                    if (in_array($a, $usedletters)) {
                        echo "<a href='#' id='".$a."' class='btn btn-primary disabled'>".$a."</a>";
                    } else {
                        echo "<form role='form' method='post' action='include/SinglplayerActions.php'>";
                        echo "<input type='hidden' name='guess' value='1'>";
                        echo "<input type='text' id='".$a."' class='btn btn-primary' name='letter' value='".$a."' style='margin-right: 2px; width: 38px; float: left;'>";
                        echo "</form>";
                    }
                }
                ?>
            </div>
        </div>
        
        
        
        
    </div>
</div>


<!-- JavaScript -->
<script>
    $(function() {
       document.addEventListener("keydown", keyDownTextField, false);
        function keyDownTextField(e) {
            
            var key = e.keyCode;
            if(key >= 65 && key <= 90) {
                var value = String.fromCharCode(key).toLowerCase();

                $.ajax({
                   method: "POST" ,
                   url: "include/SingleplayerActions.php",
                   data: {
                       guess: true,
                       letter: value
                   }
                }).done(function(msg) {
                    var data = $.parseJSON(msg);
                    console.log($('#' + value));
                    $('#' + value).addClass('disabled');
                    /* Draw Animal */
                    if (data.wrongs >= 1) {
                        $('#animal1').removeClass("hidden");
                    }
                    if (data.wrongs >= 2) {
                        $('#animal2').removeClass("hidden");
                    }
                    if (data.wrongs >= 3) {
                        $('#animal3').removeClass("hidden");
                    }
                    if (data.wrongs >= 4) {
                        $('#animal4').removeClass("hidden");
                    }
                    if (data.wrongs >= 5) {
                        $('#animal5').removeClass("hidden");
                    }
                    if (data.wrongs >= 6) {
                        $('#animal6').removeClass("hidden");
                    }
                    $('#userword').text(data.word);
                    $('#combo').text(data.combo);
                    $('#wrongs').text(data.wrongs);
                    $('#gamescore').text(data.score);
                    
                }).fail(function(msg) {
                    console.log($('#' + value));
                    console.log(msg);
                });
            }
        }
    });
</script>

<?php echo $_SESSION['singleplayer']; ?>
<!--<script>
    $(function() {
        $.ajax({
           method: "GET" ,
           url: "http://ubuntu4.javabog.dk:4176/getsomerest/webresources/singleplayer/"+<?php echo $_SESSION['singleplayer']; ?>+"/listen",
        }).done(function(msg) {
            $('#newgame').removeClass("hidden");
            console.log(msg);
        }).fail(function(msg) {
            console.log(msg);
        });
    });
</script>-->

<?php 
include ("footer.php");

} else {
	$_SESSION['alert'] = array("danger","Du skal være logget ind for at spille");
	header( "Location: index.php" );
	header( "HTTP/1.1 301 Moved Permanently" );
} ?>