<?php
    
class Multiplayer {
    
    public function __construct() {

    }
    
    public function createRoom($token) {
        $api_url = "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/multiplayer/room/create";
        $method_name = "PUT";
        
        $api_request_parameters = array(
          'token' => $token
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $postFields = http_build_query($api_request_parameters);
        $api_url .= '?' . http_build_query($api_request_parameters);
        /*
          Here you can set the Response Content Type you prefer to get :
          application/json, application/xml, text/html, text/plain, etc
        */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method_name);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $api_response = curl_exec($ch);
        $api_response_info = curl_getinfo($ch);
        curl_close($ch);

        $api_response_header = trim(substr($api_response, 0, $api_response_info['header_size']));
        $api_response_body = substr($api_response, $api_response_info['header_size']);

        if (!empty($api_response_body)) {
            $json = json_decode($api_response_body);
            
            /* Redirect */
            $_SESSION['alert'] = array("success",'You have created a new game room. ('.$json->{"roomid"}.')');
            header( "Location: ../multiplayer.php" );
            header( "HTTP/1.1 301 Moved Permanently" );
        } else {
            /* Redirect */
            $_SESSION['alert'] = array("danger","There was a error creating a new game room.");
            header( "Location: ../multiplayer.php" );
            header( "HTTP/1.1 301 Moved Permanently" ); 
        }
    }
    
    public function listRooms($token, $userid) {
        $api_url = "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/multiplayer/room/listRooms";
        
        $method_name = "GET";
        
        $api_request_parameters = array(
          'token' => $token,
          'userid' => $userid
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $api_url .= '?' . http_build_query($api_request_parameters);
        /*
          Here you can set the Response Content Type you prefer to get :
          application/json, application/xml, text/html, text/plain, etc
        */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $api_response = curl_exec($ch);
        $api_response_info = curl_getinfo($ch);
        curl_close($ch);

        $api_response_header = trim(substr($api_response, 0, $api_response_info['header_size']));
        $api_response_body = substr($api_response, $api_response_info['header_size']);

        if (!empty($api_response_body)) {
            $json = json_decode($api_response_body);
            return $json;
        } else {
            return "DER ER INGEN SPIL";
        }
    }
    
    
    public function joinRoom($roomid, $token, $userid) {
        $api_url = "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/multiplayer/room/".$roomid."/join";
        
        $method_name = "POST";
        
        $api_request_parameters = array(
          'token' => $token,
          'userid' => $userid
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $postFields = http_build_query($api_request_parameters);
        $api_url .= '?' . http_build_query($api_request_parameters);
        /*
          Here you can set the Response Content Type you prefer to get :
          application/json, application/xml, text/html, text/plain, etc
        */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $api_response = curl_exec($ch);
        $api_response_info = curl_getinfo($ch);
        curl_close($ch);

        $api_response_header = trim(substr($api_response, 0, $api_response_info['header_size']));
        $api_response_body = substr($api_response, $api_response_info['header_size']);

        if (!empty($api_response_body)) {
            $json = json_decode($api_response_body);
            
            /* Multiplayer */
            //$_SESSION['multiplayer'] = $json->{"roomid"}['0'];
            session_start();
            $_SESSION['multiplayer'] = $roomid;
            
            /* Redirect */
            $_SESSION['alert'] = array("success","Du er nu med i spillet");
            header( "Location: ../multiplayer.php" );
            header( "HTTP/1.1 301 Moved Permanently" );
        } else {
            $_SESSION['alert'] = array("danger"," DER ER INGEN MULTIPLAYER <i class='fa fa-wheelchair'></i> men vi har sendt en <i class='fa fa-ambulance' aria-hidden='true'></i> !");
            header( "Location: ../index.php?FAIL" );
            header( "HTTP/1.1 301 Moved Permanently" );
        }
    }
    
    
    // Lav om til POST
    public function leaveRoom($roomid, $token, $userid) {
        $api_url = "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/multiplayer/room/".$roomid."/leave";
        
        $method_name = "POST";
        
        $api_request_parameters = array(
          'token' => $token,
          'userid' => $userid
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $postFields = http_build_query($api_request_parameters);
        $api_url .= '?' . http_build_query($api_request_parameters);
        /*
          Here you can set the Response Content Type you prefer to get :
          application/json, application/xml, text/html, text/plain, etc
        */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $api_response = curl_exec($ch);
        $api_response_info = curl_getinfo($ch);
        curl_close($ch);

        $api_response_header = trim(substr($api_response, 0, $api_response_info['header_size']));
        $api_response_body = substr($api_response, $api_response_info['header_size']);

        if (empty($api_response_body)) {
            $json = json_decode($api_response_body);
            
            /* Multiplayer */
            //$_SESSION['multiplayer'] = $json->{"roomid"}['0'];
            session_start();
            $_SESSION['multiplayer'] = 0;
            
            /* Redirect */
            $_SESSION['alert'] = array("success","Du er nu ikke med i spillet længere");
            header( "Location: ../multiplayer.php" );
            header( "HTTP/1.1 301 Moved Permanently" );
        } else {
            $_SESSION['alert'] = array("danger"," DER ER INGEN MULTIPLAYER <i class='fa fa-wheelchair'></i> men vi har sendt en <i class='fa fa-ambulance' aria-hidden='true'></i> !");
            header( "Location: ../index.php?FAIL" );
            header( "HTTP/1.1 301 Moved Permanently" );
        }
    }
    
    public function guess($roomid, $token, $userid, $letter) {
        $api_url = "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/multiplayer/room/".$roomid."/guess";
        
        $method_name = "POST";
        
        $api_request_parameters = array(
          'token' => $token,
          'userid' => $userid,
          'letter' => $letter
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $postFields = http_build_query($api_request_parameters);
        $api_url .= '?' . http_build_query($api_request_parameters);
        /*
          Here you can set the Response Content Type you prefer to get :
          application/json, application/xml, text/html, text/plain, etc
        */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $api_response = curl_exec($ch);
        $api_response_info = curl_getinfo($ch);
        curl_close($ch);

        $api_response_header = trim(substr($api_response, 0, $api_response_info['header_size']));
        $api_response_body = substr($api_response, $api_response_info['header_size']);

        if (!empty($api_response_body)) {
            return $api_response_body;
        } else {
            $_SESSION['alert'] = array("danger"," DER ER INGEN MULTIPLAYER <i class='fa fa-wheelchair'></i> men vi har sendt en <i class='fa fa-ambulance' aria-hidden='true'></i> !");
            header( "Location: ../index.php?FAIL" );
            header( "HTTP/1.1 301 Moved Permanently" );
        }
    }
    
    public function getUserWord($roomid, $token, $userid) {
        $api_url = "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/multiplayer/room/".$roomid."/userword";
        
        $method_name = "GET";
        
        $api_request_parameters = array(
          'token' => $token,
          'userid' => $userid
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $api_url .= '?' . http_build_query($api_request_parameters);
        /*
          Here you can set the Response Content Type you prefer to get :
          application/json, application/xml, text/html, text/plain, etc
        */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $api_response = curl_exec($ch);
        $api_response_info = curl_getinfo($ch);
        curl_close($ch);

        $api_response_header = trim(substr($api_response, 0, $api_response_info['header_size']));
        $api_response_body = substr($api_response, $api_response_info['header_size']);

        if (!empty($api_response_body)) {
            $json = json_decode($api_response_body);
            return $json->userword;
        } else {
            $_SESSION['alert'] = array("danger"," DER ER INGEN MULTIPLAYER <i class='fa fa-wheelchair'></i> men vi har sendt en <i class='fa fa-ambulance' aria-hidden='true'></i> !");
            header( "Location: ../index.php?FAIL" );
            header( "HTTP/1.1 301 Moved Permanently" );
        }
    }
    
    public function nextRound($roomid, $userid) {
        $api_url = "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/multiplayer/room/".$roomid."/nextRound";
        
        $method_name = "POST";
        
        $api_request_parameters = array(
          'userid' => $userid,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $postFields = http_build_query($api_request_parameters);
        $api_url .= '?' . http_build_query($api_request_parameters);
        /*
          Here you can set the Response Content Type you prefer to get :
          application/json, application/xml, text/html, text/plain, etc
        */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $api_response = curl_exec($ch);
        $api_response_info = curl_getinfo($ch);
        curl_close($ch);

        $api_response_header = trim(substr($api_response, 0, $api_response_info['header_size']));
        $api_response_body = substr($api_response, $api_response_info['header_size']);

        if (!empty($api_response_body)) {
            return $api_response_body;
        } else {
            $_SESSION['alert'] = array("danger"," DER ER INGEN MULTIPLAYER <i class='fa fa-wheelchair'></i> men vi har sendt en <i class='fa fa-ambulance' aria-hidden='true'></i> !");
            header( "Location: ../index.php?FAIL" );
            header( "HTTP/1.1 301 Moved Permanently" );
        }
    }
    
}

$multiplayer = new Multiplayer ();
?>