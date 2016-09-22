<?php

$jsonResponse = array(
    "status" => false,
    "message" => "Please login to continue",
    "data" => null,
    "error" => array(
    )
);

if(SiteManager::getSessionInstance()->getId()) {

    $currentPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $newPassword = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_STRING);

    $loginUser = SiteManager::getUserInstance();
    $loginUser->setId(SiteManager::getSessionInstance()->getUser());

    $loginUser->load();

    $errorList = [];

    if(!$currentPassword){
        $errorList["password"] = "Current password does not match";
    }

    if(!$newPassword){
        $errorList["repassword"] = "New password is mandatory";
    }

    if(User::hashPassword($currentPassword) !== $loginUser->getPassword()){
        $errorList["repassword"] = "Current password does not match";
    }

    if(count($errorList) > 0){
        $jsonResponse["error"] = $errorList;
        $jsonResponse["message"] = "Please check all the errors";
    }
    else{
        $loginUser->setPassword(User::hashPassword($newPassword));
        if($loginUser->save()){
            $jsonResponse["status"] = true;
            $jsonResponse["message"] = "Profile details saved successfully";
        }
        else{
            $jsonResponse["message"] = "Something went wrong! Please try after some time";
        }
    }

}

echo json_encode($jsonResponse);