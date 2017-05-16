<?php
    
class Session {
    
    private $client;
    private $SOAPLIVES;
        
    public function __construct() {
        /* TO AVOID UNCATCHABLE EXCEPTION */
        $file = 'http://javabog.dk:9901/brugeradmin?wsdl';
        $file_headers = @get_headers($file);
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
            $this->SOAPLIVES = false;
            $_SESSION['SOAPLIVES']=false;
        } else {
            try {
                $this->client = new SoapClient("http://javabog.dk:9901/brugeradmin?wsdl");
            } catch (ServletException $e) {
                $_SESSION['loggedin']=false;
                $_SESSION['alert'] = array("danger","1 SOAP er retarderet <i class='fa fa-wheelchair'></i> igen, men vi har sendt en <i class='fa fa-ambulance' aria-hidden='true'></i> !");
            } catch (RuntimeException $e) {
                $_SESSION['loggedin']=false;
                $_SESSION['alert'] = array("danger","2 SOAP er retarderet <i class='fa fa-wheelchair'></i> igen, men vi har sendt en <i class='fa fa-ambulance' aria-hidden='true'></i> !");
            } catch (Exception $e) {
                $_SESSION['loggedin']=false;
                $_SESSION['alert'] = array("danger","3 SOAP er retarderet <i class='fa fa-wheelchair'></i> igen, men vi har sendt en <i class='fa fa-ambulance' aria-hidden='true'></i> !");
            }
            $this->SOAPLIVES = true;
            $_SESSION['SOAPLIVES']=true;
        }
        session_start();
    }
        
    public function login($userid, $password) {
        try {
            if ($this->SOAPLIVES) {
                $requestParams = array(
                    'arg0' => $userid,
                    'arg1' => $password
                );
                $response = $this->client->hentBruger($requestParams);
                $_SESSION['loggedin'] = true;

                $_SESSION['studentid'] = $response->return->brugernavn;
                $_SESSION['email'] = $response->return->email;
                $_SESSION['name'] = $response->return->fornavn ." ". $response->return->efternavn;
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
                header( "Location: ../index.php" );
                header( "HTTP/1.1 301 Moved Permanently" );
            }
        } catch(SoapFault $e) {
            $_SESSION['loggedin']=false;
            $_SESSION['alert'] = array("danger","SOAP FEJL!" . $e);
            header( "Location: ../index.php" );
            header( "HTTP/1.1 301 Moved Permanently" );
        } catch(Exception $e) {
            $_SESSION['loggedin']=false;
            $_SESSION['alert'] = array("danger","Forkert brugernavn eller adgangskode!");
            header( "Location: ../index.php" );
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