<?php

$jsonResponse = array(
    "status" => false,
    "message" => "Please login to continue",
    "data" => null,
    "error" => array(
    )
);

if(SiteManager::getSessionInstance()->getId()) {
    $user = SiteManager::getUserInstance();
    $user->setId(SiteManager::getSessionInstance()->getUser());
    $user->load();
    $nationalId = filter_input(INPUT_POST,'nationalId',FILTER_SANITIZE_STRING);
    $firstName = filter_input(INPUT_POST,'firstName',FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST,'lastName',FILTER_SANITIZE_STRING);

    if(!$nationalId){
        $jsonResponse["message"] = "Check errors below";
        $jsonResponse["error"]["nationalId"] = "National ID is mandatory";
    }
    else if(!$firstName){
        $jsonResponse["message"] = "Check errors below";
        $jsonResponse["error"]["firstName"] = "First Name is mandatory";
    }
    else if(Patient::checkNationalId($nationalId)){
        $jsonResponse["message"] = "Check errors below";
        $jsonResponse["error"]["nationalId"] = "Duplicate national ID";
    }

    else if(intval($user->getAccess()) < 1){
        $jsonResponse["message"] = "Check errors below";
        $jsonResponse["error"]["permission"] = "You do not have permission to add a new patient";
    }
    else{
        $patient = new Patient();
        $patient->setNationalId($nationalId);
        $patient->setFirstName($firstName);
        $patient->setLastName($lastName);

        if($patient->save()){
            $jsonResponse["status"] = true;
            $jsonResponse["message"] = "Patient added successfully";
            $jsonResponse["error"] = [];
            $jsonResponse["data"] = array(
                "id" => $patient->getId(),
                "firstName" => $patient->getFirstName(),
                "lastName" => $patient->getFirstName(),
                "nationalId" => $patient->getNationalId()
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
