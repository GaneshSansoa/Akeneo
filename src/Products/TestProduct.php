<?php
namespace App\Products;

use App\Core\Curl;

class TestProduct{
    const PRODUCTS_URL = "demo.akeneo.com/api/rest/v1/products";

        public function __construct()
        {
            if(!isset($_SESSION)){
                session_start();
            }
        }
        public function getProducts(){
            $curlObj = new Curl(self::PRODUCTS_URL, "GET", "", true, array("Authorization: Bearer ". $_SESSION["token"]));
            $res = $curlObj->exec();
            return $res;
        }
        public function getSingleProduct($id){
            $curlObj = new Curl(self::PRODUCTS_URL . "/$id", "GET", "", true, array("Authorization: Bearer ". $_SESSION["token"]));
            $res = $curlObj->exec();
            return $res;
        }
        public function updateProduct($id, $data){
            $curlObj = new Curl(self::PRODUCTS_URL . "/$id", "PATCH", $data, true, array("Authorization: Bearer ". $_SESSION["token"], "Content-Type: application/json"));
            $res = $curlObj->exec();
            return $res;
        }

}

?>