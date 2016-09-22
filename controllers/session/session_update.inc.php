<?php

$jsonResponse = array(
    "status" => false,
    "message" => "Please login to continue",
    "data" => null,
    "error" => array(
    )
);

if(SiteManager::getSessionInstance()->getId()) {

    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);

    $loginUser = SiteManager::getUserInstance();
    $loginUser->setId(SiteManager::getSessionInstance()->getUser());

    $loginUser->load();

    $loginUser->setFirstName($firstName);
    $loginUser->setLastName($lastName);


    if($loginUser->save()){
        $jsonResponse["status"] = true;
        $jsonResponse["message"] = "Profile details saved successfully";
    }
    else{
        $jsonResponse["message"] = "Something went wrong! Please try after some time";
    }

}

echo json_encode($jsonResponse);