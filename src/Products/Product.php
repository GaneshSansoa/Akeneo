<?php 
    namespace App\Products;
    class Product{
        const PRODUCTS_URL = "demo.akeneo.com/api/rest/v1/products";

        public function __construct()
        {
            if(!isset($_SESSION)){
                session_start();
            }
            echo $_SESSION["token"];
        }
        public function getProducts(){

            //Curl Init
            $ch = curl_init();

            //Inititating URL
            curl_setopt($ch, CURLOPT_URL, self::PRODUCTS_URL);

            //Set Header
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer ". $_SESSION["token"]));

            //Enable Return Resonse
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // curl_setopt($ch, CURLOPT_FAILONERROR, true);

            $result = curl_exec($ch);

            curl_close($ch);
            return json_decode($result);
        }

        public function getSingleProduct($id){

            //Curl Init
            $ch = curl_init();

            //Set URL
            curl_setopt($ch, CURLOPT_URL, self::PRODUCTS_URL . "/$id");


            //Set Header
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $_SESSION["token"]));

            //Enable Return Response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $result = curl_exec($ch);
            curl_close($ch);
            return json_decode($result);


        }
        public function updateProduct($id, $data){
            //Curl Init
            $ch = curl_init();

            //Curl Set URL;
            curl_setopt($ch, CURLOPT_URL, self::PRODUCTS_URL . "/$id");

            //CURL SET PATCH REQUEST
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");

             //Set Header
             curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $_SESSION["token"], "Content-Type: application/json"));


            //Curl Set PostData
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

            //Response 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            //EXEC
            $result = curl_exec($ch);
            //Catch Error

            curl_close($ch);
            return(json_decode($result));
        }

    }


?>