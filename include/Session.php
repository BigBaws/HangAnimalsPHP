<?php
    
class Session {
    
    public function __construct() {
        $_SESSION['loggedin'] = false;
        session_start();
    }


    public function login($userid, $password) {
        $api_url = 'http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/login';
        $method_name = 'POST';
        
        $api_request_parameters = array(
          'username' => $userid,
          'password' => $password
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

        $json = json_decode($api_response_body);
        
        if (!empty($json)) {
            /* User */
            $_SESSION['loggedin'] = true;
            $_SESSION['token'] = $json->{"token"};
            $_SESSION['name'] = $json->{"name"};
            $_SESSION['userid'] = $json->{"userid"};
            $_SESSION['email'] = $json->{"email"};
            $_SESSION['image'] = $json->{"image"};
            $_SESSION['study'] = $json->{"study"};
            $_SESSION['currency'] = $json->{"currency"};
            
            /* Singleplayer */
            $_SESSION['singleplayer'] = $json->{"singleplayer"};
            
            /* Multiplayer */
            $_SESSION['multiplayer'] = $json->{"multiplayer"};
            
            /* Animal */
            $_SESSION['animal'] = $json->{"animal"};
            $_SESSION['animalcolor'] = $json->{"animalcolor"};

            /* Redirect */
            $_SESSION['alert'] = array("success","Du er nu logget ind");
            header( "Location: ../index.php" );
            header( "HTTP/1.1 301 Moved Permanently" );
        } else {
            $_SESSION['alert'] = array("danger","Der blev returneret en tom bruger <i class='fa fa-wheelchair'></i>, men vi har sendt en <i class='fa fa-ambulance' aria-hidden='true'></i> !");
            header( "Location: ../index.php?FAIL" );
            header( "HTTP/1.1 301 Moved Permanently" );
        }
        
    }
    
    public function forgotPassword($userid) {
        try {
            if ($this->SOAPLIVES) {
                $requestParams = array(
                    'arg0' => $userid,
                    'arg1' => "http://ubuntu4.javabog.dk:4176/"
                );
            $this->client->sendGlemtAdgangskodeEmail($requestParams);
            $_SESSION['alert'] = array("success","Du har nu fået tilsendt en mail");
            header( "Location: ../index.php" );
            header( "HTTP/1.1 301 Moved Permanently" );
            }
        } catch(Exception $e) {
            $_SESSION['loggedin']=false;
            $_SESSION['alert'] = array("danger","Der gik noget galt");
            header( "Location: ../index.php" );
            header( "HTTP/1.1 301 Moved Permanently" );
        }
    }
}

$session = new Session ();
?>