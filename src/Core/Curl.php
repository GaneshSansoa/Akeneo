<?php
    namespace App\Core;

use CurlShareHandle;

class Curl{
        private $url;
        private $ch;
        private $method;
        private $data;
        private $returnTransfer;
        private $customHeaders;
        public function __construct($url,$method, $data, $returnTransfer, $customHeaders)
        {   
            //Initialize Curl
            $this->ch = curl_init();
            $this->url = $url;
            $this->method = $method;
            $this->data = $data;
            $this->returnTransfer = $returnTransfer;
            $this->customHeaders = $customHeaders;
        
        }
        public function exec(){
            //Initialize URL
            curl_setopt($this->ch, CURLOPT_URL, $this->url );
    
            //Check Method
            $this->handleMethod($this->ch, $this->method, $this->data);
            //Check Custom Header
            if(count($this->customHeaders) > 0){
                curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->customHeaders);
            }

            //Check ReturnTransfer
            if($this->returnTransfer){
                curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
            }

            //Get Result
            $result = curl_exec($this->ch);

            
            //Handle Error
            return json_decode($result);
        }
        public function __destruct()
        {
            //Close Curl
            curl_close($this->ch);
        }
        private function handleMethod($ch, $method, $data){
            switch($method){
                
                case "POST":
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    break;
                case "PUT":
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    break;
                case "PATCH":
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    break;
                default:
                    return null;
                    break;
            }
        }
    }

?>