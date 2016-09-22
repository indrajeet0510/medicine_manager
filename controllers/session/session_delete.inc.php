<?php
    $session = SiteManager::getSessionInstance();

    $session->check();
    if($session->logout()){
        echo json_encode(array(
            'auth' => false,
            'status'=> true,
            'message' => 'Logged out successfully'
        ));
    }
    else{
        echo json_encode(array(
            'auth' => false,
            'status'=> false,
            'message' => 'Something went wrong'
        ));
    }

