<?php

if(SiteManager::getSessionInstance()->getId()) {
    $listTemplate = SiteManager::getRequestParserInstance()->getViewDir() . 'patient';
    //var_dump($defaultTemplate);
    $tpl = new Template($listTemplate);
    $patientQuery = null;
    if(isset($_REQUEST['q'])){
        $patientQuery = $_REQUEST['q'];
    }

    $patients = Patient::getList($patientQuery);
    $drugs = Drug::getList();

    $tpl->set('patients',$patients);
    $tpl->set('patientQuery',$patientQuery);
    $tpl->set('drugs',$drugs);
    //var_dump($_SERVER);
    SiteManager::setHtmlPage($tpl->parse());

}
else{
    header('location: ?page=');
}
