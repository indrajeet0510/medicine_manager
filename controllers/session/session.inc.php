<?php
$loginId = filter_input(INPUT_POST,"loginId",FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_STRING);
$type = filter_input(INPUT_POST,"type", FILTER_SANITIZE_NUMBER_INT);

$session = SiteManager::getSessionInstance();

$errorList = array();

if(!$loginId){
    $errorList['loginId'] = "Enter login username,mobile or email";
}

if(!$password){
    $errorList['password'] = "Enter password";
}

if(!in_array($type,array(1,2,3,4))){
    $errorList['type'] = "User type should not be empty";
}

if(count($errorList) > 0){
    $response = [
        'status' => false,
        'auth' => false,
        'message' => 'Your username/password didn\'t matched',
        'errorList' => $errorList
    ];

    echo json_encode($response);
    return;
}


if($session->login($loginId,$password,$type)){
    if($session->getId()){
        SiteManager::getUserInstance()->setId($session->getUser());
        SiteManager::getUserInstance()->load();
        $response = [
            'status' => true,
            'auth' => true,
            'message' => 'Successfully logged in',
            'errorList' => [],
            'data' => [
                'user' => SiteManager::getUserInstance()->toJson(),
                'session' => $session->toJson()
            ]
        ];

        echo json_encode($response);
        return;
    }
    else{
        $response = [
            'status' => false,
            'auth' => false,
            'message' => 'Your username/password didn\'t matched',
            'errorList' => $errorList
        ];

        echo json_encode($response);
        return;
    }
}
else{
    $response = [
        'status' => false,
        'auth' => false,
        'message' => 'Your username/password didn\'t matched',
        'errorList' => $errorList
    ];

    echo json_encode($response);
    return;
}