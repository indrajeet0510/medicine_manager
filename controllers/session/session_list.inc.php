<?php
if(SiteManager::getSessionInstance()->getId()){
    $profileTemplate = SiteManager::getRequestParserInstance()->getViewDir().'session';
    $tpl = new Template($profileTemplate);
    $user = SiteManager::getUserInstance();
    $user->load();
    $tpl->set("user",$user);
    SiteManager::setHtmlPage($tpl->parse());
}
else{
    header('location: ?page=');
}
