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
                    
                    <div style="position: absolute; bottom: 0;">
                        <span id="chat">[28-03-2017 | 18:01:08] Thomas Anthony: Wuhu.</span>
                    </div>
                        
                </div>
                    
            </div>
        </div>
            
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="chat-list pre-scrollable">
                <ul class="nav nav-pills nav-stacked">
                    <li class="dropdown mr-5">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span id="chatname">Thomas Anthony</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="???????">View Profile</a></li>
                            <li><a href="#">Challenge</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Join Multiplayer</a></li>
                        </ul>
                    </li>
                </ul>
                
                
                <ul class="nav nav-pills nav-stacked">
                    <li class="dropdown mr-5">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span id="chatname">Søren Fritzbøger</span>
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
            <textarea class="form-control" rows="2" id="textArea"></textarea>
        </div>
            
        <div class="col-lg-3 col-md-3 col-sm-3">
            <a href="#" class="btn btn-default btn-lg btn-block">Send</a>
        </div>
            
            
            
    </div>
</div>
    


<script>
    listen = function() {
        $(function() {
            $.ajax({
               method: "GET" ,
               url: "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/chat/listen",
            }).done(function(msg) {
                $('#chat').text(msg);
                console.log(msg.winner);
                listen();
                users();
            }).fail(function(msg) {
                console.log(msg);
                listen();
                users();
            });
        });
    }
    listen();

    users = function() {
        $(function() {
            $.ajax({
               method: "GET" ,
               url: "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/chat/users",
            }).done(function(msg) {
                $('#online').text(numberofusersinchat);
                // Dette skal være en liste med personer
                // Der må også gerne være links? (profile.php?user=$userid)
                $('#chatname').text(nameofaperson);
                
                console.log("users");
            }).fail(function(msg) {
                console.log("Fail: "+msg);
            });
        });
    }
    users();

</script>



<?php 
include ("footer.php");
} else {
	$_SESSION['alert'] = array("danger","Du skal være logget ind for at spille");
	header( "Location: index.php" );
	header( "HTTP/1.1 301 Moved Permanently" );
} ?>