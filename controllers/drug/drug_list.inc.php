<?php
if(SiteManager::getSessionInstance()->getId()) {
    $listTemplate = SiteManager::getRequestParserInstance()->getViewDir() . 'mail/mail';
    //var_dump($defaultTemplate);
    $tpl = new Template($listTemplate);
    $drugQuery = null;

    if(isset($_REQUEST['q'])){
        $drugQuery = $_REQUEST['q'];
    }

    $drugs = Drug::getList($drugQuery);
    $tpl->set('drugs',$drugs);
    $tpl->set('drugQuery',$drugQuery);
    //var_dump($_SERVER);
    SiteManager::setHtmlPage($tpl->parse());

}
else{
    header('location: ?page=');
}
