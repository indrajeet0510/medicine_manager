<?php

$jsonResponse = array(
    "status" => false,
    "message" => "Please login to continue",
    "data" => [],
    "error" => array(
    )
);


if(SiteManager::getSessionInstance()->getId()) {
    //var_dump($defaultTemplate);
    $drugQuery = null;
    $drugsList = [];
//    if(isset($_REQUEST['q'])){
//        $drugQuery = $_REQUEST['q'];
//        $drugs = Drug::getList($drugQuery);
//    }
//    else{
//        $drugs = Drug::getList();
//    }
    $drugs = Drug::getList();

    for($i=0; $i<count($drugs); $i++){
        $drugObj = $drugs[$i];
        $drugData = array("id"=>$drugObj->getId(),"name"=>$drugObj->getName());
        array_push($drugsList,$drugData);
    }

    $jsonResponse["status"] = true;
    $jsonResponse["message"] = "Drugs loaded successfully";
    $jsonResponse["error"] = null;
    $jsonResponse["data"] = $drugsList;

}

echo json_encode($jsonResponse["data"]);