<?php

use App\Core\Api;
use App\Products\TestProduct;

require_once realpath("vendor/autoload.php");

    $obj = new Api("2_2igt15n1ri0wk8cwcwwows8c0sw4cssoswwokwwks0occ8swkw",
    "4mgwi6j61s84gkw8w0ss88gg4okokcw4wco4c4c4gcoco8g8o0",
    "test_2583",
    "c5fa6fcfc");
    $res = $obj->makeConnection();
    if(isset($res->access_token)){
        session_start();
        $_SESSION["token"] = $res->access_token;
        echo "Authenticated with token: $_SESSION[token] </br>";
        $prodObj = new TestProduct();

        //Get All Products
        $ress = $prodObj->getProducts();
        // echo "<pre>";
        // echo print_r($ress->_embedded->items);
        // echo "</pre>";
        foreach($ress->_embedded->items as $item){
            // echo "$item->values->name[0]->data </br>";
            echo "<pre>";
        echo print_r($item->values->name[0]->data);
        echo "</pre>";
        }

        //Get Single Product
        // $ress = $prodObj->getSingleProduct("13620748");
        // echo "<pre>";
        // echo print_r($ress);
        // echo "</pre>";

        //Update Product
        // $data = array("values" => array(
        //     "description" => array(
        //         array(
        //         "locale" => "en_US",
        //         "scope" => "ecommerce", 
        //         "data"  => "Ganesh Description",
        //         )
        //     )
        //     ));
        // $data = json_encode($data);
        // $ress = $prodObj->updateProduct("13620748", $data);
        // echo "<pre>";
        // echo print_r($ress);
        // echo "</pre>";


    }else{
        echo "</br>Error:  $res->message";
    }
?>