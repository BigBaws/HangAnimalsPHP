<?php
    
class Singleplayer {
    
    public function __construct() {

    }
    
    public function create($token, $userid, $gameid) {
        $api_url = "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/singleplayer/create";
        $method_name = "PUT";
        
        $api_request_parameters = array(
            'token' => $token,
            'userid' => $userid,
            'gameid' => $gameid
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
            $_SESSION['singleplayer'] = $json->gameid;
            return $json;
        }
    }
    
    public function guess($token, $userid, $gameid, $letter) {
        $api_url = "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/singleplayer/guess";
        
        $method_name = "POST";
        
        $api_request_parameters = array(
            'token' => $token,
            'userid' => $userid,
            'gameid' => $gameid,
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
    
    public function leave($token, $userid, $gameid) {
        $api_url = "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/singleplayer/leave";
        $method_name = "POST";
        
        $api_request_parameters = array(
            'token' => $token,
            'gameid' => $gameid,
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
            return $api_response_body;
        }
    }
    
}

$singleplayer = new Singleplayer ();
?>