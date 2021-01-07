<?php 
    namespace App\Core;
    use App\Core\Curl;
    class Api {
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
            return array("Authorization: Basic " .base64_encode("$this->clientId:$this->secret"));
        }
        public function makeConnection(){
            $curl = new Curl(self::AKENEO_URL  . "/api/oauth/v1/token","POST", $this->postConnectionData(),true,$this->buildAuthorizationHeader());
            $res = $curl->exec();
            return $res;        
        }
    }

?>