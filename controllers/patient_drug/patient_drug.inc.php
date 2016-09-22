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
    $patientId = filter_input(INPUT_POST,'patient',FILTER_SANITIZE_NUMBER_INT);
    $drugId = filter_input(INPUT_POST,'drug',FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_input(INPUT_POST,'qty',FILTER_SANITIZE_NUMBER_INT);

    if(!is_int($patientId)){
        $jsonResponse["message"] = "Check errors below";
        $jsonResponse["error"]["patient"] = "Patient is mandatory";
    }
    if(!is_int($drugId)){
        $jsonResponse["message"] = "Check errors below";
        $jsonResponse["error"]["firstName"] = "Drug is mandatory";
    }

    if(intval($user->getAccess()) < 1){
        $jsonResponse["message"] = "Check errors below";
        $jsonResponse["error"]["permission"] = "You do not have permission to add a new patient";
    }

    $patient = new Patient();
    $patient->setId($patientId);
    $drug = new Drug();
    $drug->setId($drugId);

    if(!$patient->load()){
        $jsonResponse["message"] = "Check errors below";
        $jsonResponse["error"]["patient"] = "This patient does not exists";
    }

    if(!$drug->load()){
        $jsonResponse["message"] = "Check errors below";
        $jsonResponse["error"]["patient"] = "This drug does not exists";
    }

    else{
        $patientDrugManager = new PatientDrugManager();
        $patientDrugManager->setDrug($drugId);
        $patientDrugManager->setUser(SiteManager::getUserInstance()->getId());
        $patientDrugManager->setPatient($patientId);
        $patientDrugManager->setQty($quantity);

        if($patientDrugManager->save()){
            $jsonResponse["status"] = true;
            $jsonResponse["message"] = "Drug record added successfully";
            $jsonResponse["error"] = [];
            $jsonResponse["data"] = array(
                "id" => $patientDrugManager->getId(),
                "drug" => $patientDrugManager->getDrug(),
                "user" => $patientDrugManager->getUser(),
                "patient" => $patientDrugManager->getPatient(),
                "qty" => $patientDrugManager->getQty()
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
