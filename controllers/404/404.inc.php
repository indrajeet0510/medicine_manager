<?php
    $pageNotFoundTemplate = SiteManager::getRequestParserInstance()->getViewDir().'404';
    $tpl = new Template($pageNotFoundTemplate);
    //var_dump($_SERVER);
    SiteManager::setHtmlPage($tpl->parse());