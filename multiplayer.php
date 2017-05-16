<?php 
include ("header.php");
include ("include/Multiplayer.php");

if($_SESSION['loggedin']){
    $multiplayer = new Multiplayer();
    
    $usedletters = array(
    );
    $alphabet = array(
        "a", "b", "c", "d", "e", "f", "g",
        "h", "i", "j", "k", "l", "m", "n",
        "o", "p", "q", "r", "s", "t", "u",
        "v", "w", "x", "y", "z"
        );
?>

<div class="container">
    
    <div class="row">
        
        <?php
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
        
        
        <?php
        if (empty($_SESSION['multiplayer'])) {
        ?>
        <div class="col-lg-12 col-md-12 col-sm-12 mb-5">
            <h1>Multiplayer Games</h1>
        </div>
            
        <?php 
        $games = $multiplayer->listRooms($_SESSION['token'], $_SESSION['userid']);
        ?>
        <div class="col-lg-12 col-md-12 col-sm-12 mb-5">
            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                        <th>Room id</th>
                        <th>Round</th>
                        <th>Players</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($games->games as $g) {
                ?>
                    <tr>
                        <td><h3><?php print_r($g->roomid); ?></h3></td>
                        <td><h3>?</h3></td>
                        <td><h3>? / ?</h3></td>
                        <td>
                            <form role="form" method="post" action="include/MultiplayerActions.php">
                                <input type="hidden" name="roomid" value="<?php echo $g->roomid; ?>">
                                <input type="hidden" id="join" name="join" value="1">
                                <input type="submit" class="btn btn-primary btn-sm btn-block" value="Join">
                            </form>
                        </td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
        
        <div class="col-lg-12 col-md-12 col-sm-12 mb-5">
            <h1>Create room</h1>
            
            <form role="form" method="post" action="include/MultiplayerActions.php">
                <input type="hidden" name="createRoom" value="1">
                <input type="submit" class="btn btn-primary btn-sm btn-block" value="Create New Room">
            </form>
            
        </div>
    <?php
    } else {
    ?>
        
        
        <div class="col-lg-12 col-md-12 col-sm-12 mb-5">
            <h3>HangAnimals <small>(Multiplayer room: <?php echo $_SESSION['multiplayer']; ?>)</small></h3>
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
                    <h3 id="userword"><?php echo $multiplayer->getUserWord($_SESSION['multiplayer'], $_SESSION['token'], $_SESSION['userid']) ?></h3>
                    <br><br>
                    OR I will hang your animal...muhahahahhahaha<br>
                    hahahahaahahahahahahahahahhaahhahahaha
                    
                    <img src="images/death.png" style="margin-top: 50px" height="180">
                </div>
                <div class="clearfix"></div>
            </div>
                
        </div>
            
        <div class="col-lg-3 col-md-3 col-sm-3">
            
            <div class="well hidden" id="winners">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        The Winner is:
                        <h3 style="color: #2f7d2f;"><span id="winnername"></span></h3>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-10 text-center">
                        10 Seconds left.
                    </div>
                </div>
            </div>
            
            <div class="clearfix"></div>
            
            <div class="well">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <h3>Contesters</h3>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        Name
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                        Gamescore
                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <span id="participantsname"></span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 text-right">
                        <span id="participantsgamescore"></span>
                    </div>
                </div>
            </div>
            
            <div class="clearfix"></div>
            
            <div class="well">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    Wrongs
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                    <span id="wrongs">0</span>
                </div>
                    
                <div class="clearfix"></div>
                    
            </div>
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <form role="form" method="post" action="include/MultiplayerActions.php">
                        <input type="hidden" name="roomid" value="<?php echo $_SESSION['multiplayer']; ?>">
                        <input type="hidden" name="leave" value="1">
                        <input type="submit" class="btn btn-primary btn-sm btn-block" id="leave" value="Leave">
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
                        echo "<form role='form' method='post' action='include/MultiplayerActions.php'>";
                        echo "<input type='hidden' name='guess' value='1'>";
                        echo "<input type='hidden' name='roomid' value='".$_SESSION['multiplayer']."'>";
                        echo "<input type='hidden' name='token' value='".$_SESSION['token']."'>";
                        echo "<input type='hidden' name='userid' value='".$_SESSION['userid']."'>";
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
                   url: "include/MultiplayerActions.php",
                   data: {
                       guess: true,
                       roomid: '<?php echo $_SESSION['multiplayer']; ?>',
                       letter: value
                   }
                }).done(function(msg) {
                    var data = $.parseJSON(msg);
                    $('#userword').text(data.word);
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
                    $('#wrongs').text(data.wrongs);
                    $('#gamescore').text(data.score);
                }).fail(function(msg) {
                    console.log(msg);
                });
            }
        }
    });
</script>


<script>
    listen = function() {
        $(function() {
            $.ajax({
               method: "GET" ,
               url: "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/multiplayer/room/<?php echo $_SESSION['multiplayer']; ?>/listen",
            }).done(function(msg) {
                $('#winners').addClass("hidden");
                //$('#winnername').text(msg.winner);
                $('#userword').text(msg.userword);

                $("input").removeClass('disabled');

                console.log(msg.winner);
                listen();
                won();
            }).fail(function(msg) {
                    console.log(msg);
                    listen();
                    won();
                });
        });
    }
    listen();

    won = function() {
        $(function() {
            $.ajax({
               method: "GET" ,
               url: "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/multiplayer/room/<?php echo $_SESSION['multiplayer']; ?>/won",
            }).done(function(msg) {
                $('#winners').removeClass("hidden");
                $('#winnername').text(msg.winner);
                
                console.log("nextRound");
            }).fail(function(msg) {
                console.log("Fail: "+msg);
            });
        });
    }

    won();

</script>

<script>
    $(function() {
        // function pull_highscores() {
        //     $.ajax({
        //        method: "GET" ,
        //        url: "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/multiplayer/room/<?php echo $_SESSION['multiplayer']; ?>/users?token=<?php echo $_SESSION['token']; ?>",
        //     }).done(function(msg) {
        //         var names = "";
        //         var scores = "";
                
        //         $.each(msg.users, function(userindex, user){
        //             names += user.name + "<br />";
        //             scores += user.gamescore + "<br />";
        //         });
                
                
        //         $('#participantsname').html(names); 
        //         $('#participantsgamescore').html(scores);
        //     }).fail(function(msg) {
        //             console.log(msg);
        //         });
        // }
        
        window.setInterval(function() {
             $.ajax({
               method: "GET" ,
               url: "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/multiplayer/room/<?php echo $_SESSION['multiplayer']; ?>/users?token=<?php echo $_SESSION['token']; ?>",
            }).done(function(msg) {
                var names = "";
                var scores = "";
                
                $.each(msg.users, function(userindex, user){
                    names += user.name + "<br />";
                    scores += user.gamescore + "<br />";
                });
                
                
                $('#participantsname').html(names); 
                $('#participantsgamescore').html(scores);
            }).fail(function(msg) {
                    console.log(msg);
                });
        }, 1000);
           
        });
</script>


<!-- <script>
    $(function() {
            $.ajax({
               method: "GET" ,
               url: "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/multiplayer/room/<?php echo $_SESSION['multiplayer']; ?>/nextRound",
            }).done(function(msg) {
                $('#winners').addClass("hidden");
                $('#userword').text(msg.word);
                location.reload(false);
                console.log("nextRound");
            }).fail(function(msg) {
                console.log("Fail: "+msg);
            });
        });
</script> -->

<?php 
include ("footer.php");
    }
} else {
	$_SESSION['alert'] = array("danger","Du skal være logget ind for at spille");
	header( "Location: index.php" );
	header( "HTTP/1.1 301 Moved Permanently" );
} ?>