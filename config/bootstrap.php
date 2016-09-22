<?php
//    $db = SiteManager::getDBInstance();
    SiteManager::getPage();
    $requestParser = SiteManager::getRequestParserInstance();
    $session = SiteManager::getSessionInstance();

    $user = SiteManager::getUserInstance();
    if($user->getId()){
        $user->load();
    }

    if(SiteManager::getHtmlPage()){

        // Including Header
        include_once ConfigurationManager::getViewsDirectory().'default/header.tpl.php';

        echo '<div id="wrapper">';
        echo SiteManager::getHtmlPage();
        echo '</div>';
        // Including Footer
        include_once ConfigurationManager::getViewsDirectory().'default/footer.tpl.php';

        unset($_SESSION['error']);
    }






