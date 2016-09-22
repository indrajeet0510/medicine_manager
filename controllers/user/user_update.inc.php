<?php
$jsonResponse = array(
    "status" => false,
    "message" => "Please login to continue",
    "data" => null,
    "error" => array(
    )
);

if(SiteManager::getSessionInstance()->getId()) {
    $id = filter_input(INPUT_POST,'user',FILTER_SANITIZE_NUMBER_INT);
    $access = filter_input(INPUT_POST,'access',FILTER_SANITIZE_NUMBER_INT);

    $loginUser = SiteManager::getUserInstance();
    $loginUser->setId(SiteManager::getSessionInstance()->getUser());
    $loginUser->load();

    $errorList = array();

    $user = new User();
    $user->setId($id);


    if(!$id){
        $errorList["user"] = "User does not exists";
    }

    if(is_int($access)){
        $errorList["user"] = "Please select access rights";
    }

    if(!$user->load()){
        $errorList["user"] = "User does not exists";
    }

    if(intval($loginUser->getAccess()) < 2){
        $errorList["permission"] = "You do not have permission to update this user";
    }

    if(count($errorList) > 0){
        $jsonResponse["error"] = $errorList;
        $jsonResponse["message"] = "Please check the errors below";
    }
    else{
        $user->setAccess($access);

        if($user->save()){
            $jsonResponse["status"] = true;
            $jsonResponse["message"] = "User rights updated successfully";
            $jsonResponse["error"] = [];
            $jsonResponse["data"] = array(
                "id" => $user->getId(),
                "firstName" => $user->getFirstName(),
                "lastName" => $user->getLastName(),
                "username" => $user->getUsername(),
                "access" => $user->getAccess()
            );
        }
        else{
            $jsonResponse["message"] = "Something went wrong ! Please try again";
            $jsonResponse["error"] = array();
        }
    }
}

echo json_encode($jsonResponse);



