<?php
    
class Chat {
    
    public function __construct() {

    }
    
    public function sendMessage($token, $userid, $message) {
        $api_url = "http://ubuntu4.javabog.dk:4176/HangAnimalsREST/webresources/chat/send";
        $method_name = "PUT";
        
        $api_request_parameters = array(
            'token' => $token,
            'userid' => $userid,
            'message' => $message,
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
            header( "Location: ../multiplayer.php" );
            header( "HTTP/1.1 301 Moved Permanently" );
        }
    }
    
}

$chat = new Chat ();
?>