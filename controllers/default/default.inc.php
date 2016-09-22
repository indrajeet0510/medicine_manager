<?php
//    SiteManager::getSessionInstance()->check();
//    if(SiteManager::getSessionInstance()->getId()){
//        $defaultTemplate = SiteManager::getRequestParserInstance()->getViewDir().'default_landing';
//        $tpl = new Template($defaultTemplate);
//        //var_dump($_SERVER);
//        SiteManager::setHtmlPage($tpl->parse());
//    }
//    else{
//        $defaultTemplate =SiteManager::getRequestParserInstance()->getViewDir().'default';
//        $error = null;
//        if(isset($_SESSION['error'])){
//            $error = $_SESSION['error'];
//        }
//        $tpl = new Template($defaultTemplate);
//        $tpl->set('error',$error);
//        //var_dump($_SERVER);
//        SiteManager::setHtmlPage($tpl->parse());
//    }

    SiteManager::getSessionInstance()->check();
    if(SiteManager::getSessionInstance()->getId()){

    }
    else{

    }

//    echo "cookie";
//    var_dump($_COOKIE);