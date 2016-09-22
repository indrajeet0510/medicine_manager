<?php

if(SiteManager::getSessionInstance()->getId()) {

    $loginUser = SiteManager::getUserInstance();
    $loginUser->setId(SiteManager::getSessionInstance()->getUser());
    $loginUser->load();

    $defaultTemplate = SiteManager::getRequestParserInstance()->getViewDir() . 'patient_drug';
    $recordQuery = "";

    $patientId = null;
    $drugId = null;

    if(isset($_REQUEST['p'])){
        $patientId = filter_input(INPUT_GET,'p',FILTER_SANITIZE_NUMBER_INT);
        $patient = new Patient();
        $patient->setId($patientId);
        if($patient->load()){
            $recordQuery .= ("patient ".strtoupper($patient->getFirstName()." ".$patient->getLastName()));
        }
        else{
            $patient = null;
        }

    }

    if(isset($_REQUEST['d'])){
        $drugId = filter_input(INPUT_REQUEST,'d',FILTER_SANITIZE_NUMBER_INT);
        $drug = new Drug();
        $drug->setId($drugId);
        if($drug->load()){
            $recordQuery .= ("drug ".strtoupper($drug->getName()));
        }
        else{
            $drug = null;
        }
    }

    $records = PatientDrugManager::getList($patientId,$drugId);
    $tpl = new Template($defaultTemplate);
    $tpl->set('records',$records);
    $tpl->set('loginUser',$loginUser);
    $tpl->set('recordQuery',$recordQuery);
    SiteManager::setHtmlPage($tpl->parse());

}
else{
    header('location: ?page=');
}
