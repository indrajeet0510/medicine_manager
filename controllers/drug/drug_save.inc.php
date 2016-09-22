<?php

$jsonResponse = array(
    "status" => false,
    "message" => "Please login to continue",
    "data" => null,
    "error" => array(
    )
);

if(SiteManager::getSessionInstance()->getId()) {
    $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING);
    $code = filter_input(INPUT_POST,'code',FILTER_SANITIZE_STRING);

    $user = SiteManager::getUserInstance();
    $user->setId(SiteManager::getSessionInstance()->getUser());
    $user->load();

    if(!$name){
        $jsonResponse["message"] = "Check errors below";
        $jsonResponse["error"]["name"] = "Drug name is mandatory";
    }
    else if(intval($user->getAccess()) < 1){
        $jsonResponse["error"]["permission"] = "You do not have permission to add a new drug";
    }
    else{
        $drug = new Drug();
        $drug->setName($name);
        $drug->setCode($code);

        if($drug->save()){
            $jsonResponse["status"] = true;
            $jsonResponse["message"] = "Drug added successfully";
            $jsonResponse["error"] = [];
            $jsonResponse["data"] = array(
                "id" => $drug->getId(),
                "name" => $drug->getName(),
                "code" => $drug->getCode()
            );
        }
        else{
            $jsonResponse["message"] = "Something went wrong ! Please try again";
            $jsonResponse["error"] = array();
        }
    }

}
else{
    $jsonResponse = array(
        "status" => false,
        "message" => "Please login to continue",
        "data" => null,
        "error" => array(
            "session" => "Please login to continue"
        )
    );
}

echo json_encode($jsonResponse);
