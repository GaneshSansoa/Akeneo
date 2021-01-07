<?php 
namespace App\Core;

class AkeneoAPI{
    private $clientId;
    private $secret;
    private $username;
    private $password;
    private $accessToken;
    private $refreshToken;
    private const AKENEO_URL = "demo.akeneo.com";
    public function __construct($clientId, $secret, $username, $password){
        $this->clientId = $clientId;
        $this->secret = $secret;
        $this->username = $username;
        $this->password = $password;
    }
    private function postConnectionData(){
        //Build Connection Query
        return http_build_query(array("username"=> $this->username, "password" => $this->password, "grant_type" => "password"));
    }
    private function buildAuthorizationHeader(){
        //Generate Base64 Encoded String for authorization
        return base64_encode("$this->clientId:$this->secret");
    }
    public function makeConnection(){
       
        //Curl Init
        $ch = curl_init();

        //Setting up API URL
        curl_setopt($ch, CURLOPT_URL, self::AKENEO_URL . "/api/oauth/v1/token");
        
        //Set Request Type
        curl_setopt($ch, CURLOPT_POST, 1);

        //POst Data
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->postConnectionData());

        //Set Custom Authorization Header
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Basic ". $this->buildAuthorizationHeader()));
        
        //Enabling Storing Return Response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        
        //Storing Response
        $result = curl_exec($ch);
        
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        
        if ( $e = curl_error($ch)) {
            //Return Error
            // return $e;
            //Return Response
            return json_encode(array("status" => "error", "message" => $e));die;
        }else{            
            
            $decoded = json_decode($result);

            $this->accessToken = $decoded->access_token;
            $this->refreshToken = $decoded->refresh_token;
            session_start();
            $_SESSION["token"] = $this->accessToken;
            //Return Response
            return json_encode(array("status" => "success", "message" => "Successfully Connected"));
            }
        }
}

