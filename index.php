<?php

use App\Core\AkeneoAPI;
use App\Products\Product;

require_once realpath("vendor/autoload.php");

    //Making API Object
    $apiObj = new AkeneoAPI("CLIENT_ID",
    "SECRET",
    "USERNAME",
    "PASSWORD");

    //Make Connection
    $res = $apiObj->makeConnection();

    //Making Products Object
    $prodObj = new Product();

    //Fetching Products
    // $products = $prodObj->getProducts();

    // echo "<pre>";
    // echo print_r($products);
    // echo "</pre>";
    

   

    //Update Products Data
    $data = array("values" => array(
        "description" => array(
            array(
            "locale" => "en_US",
            "scope" => "ecommerce", 
            "data"  => "Test Description",
            )
        )
        ));
    $data = json_encode($data);

    $updateProduct = $prodObj->updateProduct("13620748", $data);
    echo "<pre>";
    echo print_r($updateProduct);
    echo "</pre>";


     //Fetching Single Product
     $singleProduct = $prodObj->getSingleProduct("13620748");
     echo "<pre>";
     echo print_r($singleProduct);
     echo "</pre>";
?>
