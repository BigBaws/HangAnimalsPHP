<?php
    
class Session {
    
    private $auth_url;
    private $api_url = 'http://ubuntu4.javabog.dk:4176/getsomerest/webresources/';
        
    public function __construct() {
        $_SESSION['loggedin']=false;
        session_start();
//        $service_url = 'http://ubuntu4.javabog.dk:4176/getsomerest/webresources/login?username=s154176&password=qwe123';
//$curl = curl_init($service_url);
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//$curl_response = curl_exec($curl);
//if ($curl_response === false) {
//    $info = curl_getinfo($curl);
//    curl_close($curl);
//    die('error occured during curl exec. Additioanl info: ' . var_export($info));
//}
//curl_close($curl);
//
//$decoded = json_decode($curl_response);
//if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
//    die('error occured: ' . $decoded->response->errormessage);
//}
//
//$obj = json_decode($curl_response);
//print_r ($obj->{"token"}['0']); // 12345
//echo "<br>";
//print_r($curl_response);
//echo "<br>";
//var_dump(json_decode($curl_response, true));
//echo "<br>";
//print_r(json_decode($curl_response));
//echo "<br>";
//var_dump(json_decode($curl_response));
//echo "<br>";
//var_dump($decoded);
//echo "<br>";
//echo 'response ok!';
//var_export($decoded->response);
    }


    public function login($userid, $password) {
        $api_url = 'http://ubuntu4.javabog.dk:4176/getsomerest/webresources/login';
        /*
          Which Request Method do I want to use ?
          DELETE, GET, POST or PUT
        */
        $method_name = 'GET';
        
        $api_request_parameters = array(
          'username' => $userid,
          'password' => $password
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        if ($method_name == 'DELETE')
        {
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
          curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($api_request_parameters));
        }

        if ($method_name == 'GET')
        {
          $api_url .= '?' . http_build_query($api_request_parameters);
        }

        if ($method_name == 'POST')
        {
          curl_setopt($ch, CURLOPT_POST, TRUE);
          curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($api_request_parameters));
        }

        if ($method_name == 'PUT')
        {
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
          curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($api_request_parameters));
        }

        /*
          Here you can set the Response Content Type you prefer to get :
          application/json, application/xml, text/html, text/plain, etc
        */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));

        /*
          Let's give the Request Url to Curl
        */
        curl_setopt($ch, CURLOPT_URL, $api_url);

        /*
          Yes we want to get the Response Header
          (it will be mixed with the response body but we'll separate that after)
        */
        curl_setopt($ch, CURLOPT_HEADER, TRUE);

        /*
          Allows Curl to connect to an API server through HTTPS
        */
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        /*
          Let's get the Response !
        */
        $api_response = curl_exec($ch);

        /*
          We need to get Curl infos for the header_size and the http_code
        */
        $api_response_info = curl_getinfo($ch);

        /*
          Don't forget to close Curl
        */
        curl_close($ch);

        /*
          Here we separate the Response Header from the Response Body
        */
        $api_response_header = trim(substr($api_response, 0, $api_response_info['header_size']));
        $api_response_body = substr($api_response, $api_response_info['header_size']);

        // Response HTTP Status Code
        echo $api_response_info['http_code'];

        // Response Header
        echo $api_response_header;

        // Response Body
        echo "<br><br>";
        echo $api_response_body;
        
        
        if (!empty($api_response_body)) {
                $_SESSION['loggedin'] = true;

                echo "<br>lol<br>";
                echo $api_response_body->{"token"}['0'];
                echo "<br><br>";
                
                $_SESSION['token'] = $api_response_body->{"token"}['0'];
                $_SESSION['studentid'] = $api_response_body->{"brugernavn"}['0'];
                $_SESSION['email'] = $api_response_body->{"email"}['0'];
                $_SESSION['name'] = $api_response_body->{"fornavn"}['0'] ." ". $api_response_body->{"efternavn"}['0'];
                
                $_SESSION['active'] = $response->return->sidstAktiv;
                $_SESSION['campusnetid'] = $response->return->campusnetId;
                $_SESSION['kanelgiffel'] = $response->return->studeretning;
//                $_SESSION['link'] = $response->return->ekstraFelter->entry['0']->value;
                
                /* Animal */
                
                
                /* Redirect */
                $_SESSION['alert'] = array("success","Du er nu logget ind");
                header( "Location: ../index.php" );
                header( "HTTP/1.1 301 Moved Permanently" );
            } else {
                $_SESSION['alert'] = array("danger","1a SOAP er retarderet <i class='fa fa-wheelchair'></i> igen, men vi har sendt en <i class='fa fa-ambulance' aria-hidden='true'></i> !");
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