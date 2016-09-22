<?php

if(SiteManager::getSessionInstance()->getId()) {

    $loginUser = SiteManager::getUserInstance();
    $loginUser->setId(SiteManager::getSessionInstance()->getUser());
    $loginUser->load();

    $defaultTemplate = SiteManager::getRequestParserInstance()->getViewDir() . 'user';
    $userQuery = null;

    if(isset($_REQUEST['q'])){
        $userQuery = $_REQUEST['q'];
    }

    $users = User::getList($userQuery);
    $tpl = new Template($defaultTemplate);
    $permissionList = array('2' => 'Master', '0' => 'Read Only', '1' => 'Read and write');
    $tpl->set('permissionList',$permissionList);
    $tpl->set('users',$users);
    $tpl->set('loginUser',$loginUser);
    $tpl->set('userQuery',$userQuery);
    //var_dump($_SERVER);
    SiteManager::setHtmlPage($tpl->parse());

}
else{
    header('location: ?page=');
}
