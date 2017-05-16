<?php 
include ("header.php");
if($_SESSION['loggedin']){
    
?>
<div class="container">
    
    <div class="row">
        
        <div class="col-lg-9 col-md-9 col-sm-9 mb-0">
            <h3>Chat</h3>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 mb-0">
            <h5>Online (<span id="online">?</span>)</h5>
        </div>
        
    </div>
          
    <div class="row">
        
        <div class="col-lg-9 col-md-9 col-sm-9">
            <div class="well">
                
                <div class="Chat" style="height: 400px; white-space: nowrap; overflow-y: scroll;">
                    
                    <div id="chat-content" style="position: absolute; bottom: 0;">
                        <span id="chat"></span>
                    </div>
                        
                </div>
                    
            </div>
        </div>
            
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="chat-list pre-scrollable">
                <ul class="nav nav-pills nav-stacked">
                    <li class="dropdown mr-5">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span id="chatonline">Thomas Anthony</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">View Profile</a></li>
                            <li><a href="#">Challenge</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Join Multiplayer</a></li>
                        </ul>
                    </li>
                </ul>
                
                
                <ul class="nav nav-pills nav-stacked">
                    <li class="dropdown mr-5">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span id="chatonline">Søren Fritzbøger</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">View Profile</a></li>
                            <li><a href="#">Challenge</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Join Multiplayer</a></li>
                        </ul>
                    </li>
                </ul>

                
                
            </div>
        </div>
            
        <div class="col-lg-9 col-md-9 col-sm-9" style="display: table-cell; vertical-align: bottom;">
            <textarea class="form-control" id="message" rows="2" id="textArea"></textarea>
        </div>
            
        <div class="col-lg-3 col-md-3 col-sm-3">
            <a href="#" id="send" class="btn btn-default btn-lg btn-block">Send</a>
        </div>
            
            
            
    </div>
</div>

<script>
    $(function() {
        listen = function() {
            $.ajax({
               method: "GET" ,
               url: "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/chat/listen/<?php echo $_SESSION['userid']; ?>",
            }).done(function(msg) {
                console.log(msg);
                var html = "<p>Some HTML</p>";
                var div = document.createElement("div");
                div.innerHTML = msg;
                var text = div.textContent || div.innerText || "";
                $('#chat').append(text);
                listen();
            }).fail(function(msg) {
                var html = "<p>Some HTML</p>";
                var div = document.createElement("div");
                div.innerHTML = msg.responseText;
                var text = div.textContent || div.innerText || "";
                $('#chat').append('<br />' + text);
                listen();
            });
        }
        listen();

        $('body').on('click', '#send', function() {
            $.ajax({
                method: "POST" ,
                data: {
                    token: '<?php echo $_SESSION['token']; ?>',
                    userid: '<?php echo $_SESSION['userid']; ?>',
                    message: $('#message').val()
                },
                url: "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/chat/send"
            }).done(function(msg) {
                console.log(msg);
                $('#message').val('');
            }).fail(function(msg) {
                console.log(msg);
                $('#message').val('');
            });
        });
    });

    // won = function() {
    //     $(function() {
    //         $.ajax({
    //            method: "GET" ,
    //            url: "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/multiplayer/room/<?php echo $_SESSION['multiplayer']; ?>/won",
    //         }).done(function(msg) {
    //             $('#winners').removeClass("hidden");
    //             $('#winnername').text(msg.winner);
                
    //             console.log("nextRound");
    //         }).fail(function(msg) {
    //             console.log("Fail: "+msg);
    //         });
    //     });
    // }

    // won();

</script>
    
<?php 
include ("footer.php");
} else {
	$_SESSION['alert'] = array("danger","Du skal være logget ind for at spille");
	header( "Location: index.php" );
	header( "HTTP/1.1 301 Moved Permanently" );
} ?>