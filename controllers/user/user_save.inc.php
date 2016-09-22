<?php

    $type = filter_input(INPUT_POST,'type',FILTER_SANITIZE_NUMBER_INT);

    $errorList = array();

    $mobile = filter_input(INPUT_POST,'mobile',FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);

    if($email && (!filter_var($email, FILTER_VALIDATE_EMAIL))){
        $errorList['email'] = 'Invalid email';
    }
    else {
        if(!$mobile){
            $errorList['email'] = 'Email/Mobile is required';
        }
    }

    switch ($type){
        case 1 :
            /**
             * Customer
             */
            $firstName = filter_input(INPUT_POST,'firstName',FILTER_SANITIZE_STRING);
            $lastName = filter_input(INPUT_POST,'lastName',FILTER_SANITIZE_STRING);


            if(!$firstName){
                $errorList['firstName'] = "First name cannot be empty";
            }

            if($email && (!User::checkEmail($email,$type))){
                $errorList['email'] = "Email is already registered";
            }

            if($mobile && (!User::checkMobile($mobile,$type))){
                $errorList['mobile'] = "Mobile number is already registered";
            }

            if($username && (!User::checkUsername($username,$type))){
                $errorList['username'] = "Username is not available";
            }

            if(sizeof($errorList) > 0){
                echo json_encode(array(
                    'status' => false,
                    'auth' => false,
                    'message' => 'Please check the errors',
                    'errorList' => $errorList
                ));
                return;
            }


            $user = SiteManager::getUserInstance();

            $user->setUsername($username);
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setMobile($mobile);
            $user->setEmail($email);
            $user->setType(1);

            $ignoreList = array('id','dateOfBirth','status','password','gender','searchKeywords');

            if($mobile){
                array_push($ignoreList,'mobile');
            }

            if($lastName){
                array_push($ignoreList,'lastName');
            }


            if($user->save($ignoreList)){
                echo json_encode(array(
                    'status' => true,
                    'auth' => true,
                    'message' => 'User saved successfully',
                    'data' => $user->toJson()
                ));
                return;
            }

            else{
                echo json_encode(array(
                    'status' => false,
                    'auth' => false,
                    'message' => 'Something went wrong'
                ));
                return;
            }

            break;

        case 2;
            /**
             * Merchant
             */

            $merchantName = filter_input(INPUT_POST,'merchantName',FILTER_SANITIZE_STRING);
            $storeName = filter_input(INPUT_POST,'storeName',FILTER_SANITIZE_STRING);
            $addressLine1 = filter_input(INPUT_POST,'addressLine1',FILTER_SANITIZE_STRING);
            $addressLine2 = filter_input(INPUT_POST,'addressLine2',FILTER_SANITIZE_STRING);
            $city = filter_input(INPUT_POST,'city',FILTER_SANITIZE_STRING);
            $state = filter_input(INPUT_POST,'state',FILTER_SANITIZE_STRING);
            $country = filter_input(INPUT_POST,'country',FILTER_SANITIZE_STRING);
            $postalCode = filter_input(INPUT_POST,'postalCode',FILTER_SANITIZE_STRING);
            $locationIdentifier = filter_input(INPUT_POST,'locationIdentifier',FILTER_SANITIZE_STRING);

            $phoneNumber = filter_input(INPUT_POST,'phoneNumber',FILTER_SANITIZE_STRING);
            $vatTIN = filter_input(INPUT_POST,'vatTIN',FILTER_SANITIZE_STRING);
            $vat = filter_input(INPUT_POST,'vat',FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
            $serviceTaxNumber = filter_input(INPUT_POST,'serviceTaxNumber',FILTER_SANITIZE_STRING);
            $serviceTax = filter_input(INPUT_POST,'serviceTax',FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);


            if(!$merchantName){
                $errorList['merchantName'] = "Merchant name cannot be empty";
            }

            if(!$storeName){
                $errorList['storeName'] = "Store name cannot be empty";
            }

            if(!$addressLine1){
                $errorList['addressLine1'] = "Address Line 1 cannot be empty";
            }

            if(!$city){
                $errorList['city'] = "City cannot be empty";
            }

            if(!$state){
                $errorList['state'] = "State cannot be empty";
            }

            if(!$country){
                $errorList['country'] = "Country cannot be empty";
            }

            if(!$locationIdentifier){
                $errorList['locationIdentifier'] = "Location Identifier cannot be empty";
            }

            if(!$phoneNumber){
                $errorList['phoneNumber'] = "Phone number cannot be empty";
            }

            if(!$vatTIN){
                $errorList['vatTIN'] = "VAT/TIN number is mandatory";
            }

            if(!$serviceTaxNumber){
                $errorList['serviceTaxNumber'] = "Service tax number is mandatory";
            }

            if(!$serviceTax){
                $errorList['serviceTax'] = "Service tax %(percentage) is mandatory";
            }

            if(!$vat){
                $errorList['vat'] = "VAT %(percentage) is mandatory";
            }

            if(!$password){
                $errorList['password'] = "Password is mandatory";
            }


            if($email && (!User::checkEmail($email,$type))){
                $errorList['email'] = "Email is already registered";
            }

            if($mobile && (!User::checkMobile($mobile,$type))){
                $errorList['mobile'] = "Mobile number is already registered";
            }

            if($username && (!User::checkUsername($username,$type))){
                $errorList['username'] = "Username is not available";
            }

            if(sizeof($errorList) > 0){
                echo json_encode(array(
                    'status' => false,
                    'auth' => false,
                    'message' => 'Please check the errors',
                    'errorList' => $errorList
                ));
                exit();
            }

            $user = SiteManager::getUserInstance();

            $user->setUsername($username);
            $user->setMobile($mobile);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setType(2);

            $ignoreList = array('id','dateOfBirth','status','gender','searchKeywords');

            if($user->save($ignoreList)){

                $merchant = new Merchant();

                $merchant->setUser($user->getId());
                $merchant->setUpdatedBy($user->getId());
                $merchant->setMerchantName($merchantName);
                $merchant->setStoreName($storeName);
                $merchant->setPhoneNumber($phoneNumber);
                $merchant->setAddressLine1($addressLine1);
                $merchant->setAddressLine2($addressLine2);

                $merchant->setCity($city);
                $merchant->setState($state);
                $merchant->setCountry($country);
                $merchant->setPostalCode($postalCode);
                $merchant->setLocationIdentifier($locationIdentifier);
                $merchant->setVatTIN($vatTIN);
                $merchant->setServiceTaxNumber($serviceTaxNumber);
                $merchant->setVat($vat);
                $merchant->setServiceTax($serviceTax);

                $ignoreList = array('id');


                if(!$addressLine2){
                    array_push($ignoreList,'addressLine2');
                }

                if($merchant->save($ignoreList)){
                    echo json_encode(array(
                        'status' => true,
                        'auth' => true,
                        'message' => 'User saved successfully',
                        'data' => $user->toJson()
                    ));
                    exit();
                }
                else{
                    echo json_encode(array(
                        'status' => false,
                        'auth' => false,
                        'message' => 'Something went wrong'
                    ));
                    exit();
                }


            }

            else{
                echo json_encode(array(
                    'status' => false,
                    'auth' => false,
                    'message' => 'Something went wrong'
                ));
                exit();
            }

            break;

        case 3:
            /**
             * Admin Employees
             */

            /**
             * Customer
             */
            $firstName = filter_input(INPUT_POST,'firstName',FILTER_SANITIZE_STRING);
            $lastName = filter_input(INPUT_POST,'lastName',FILTER_SANITIZE_STRING);

            if(!$password){
                $errorList['password'] = "Password is mandatory";
            }

            if(!$firstName){
                $errorList['firstName'] = "First name cannot be empty";
            }

            if($email && (!User::checkEmail($email,$type))){
                $errorList['email'] = "Email is already registered";
            }

            if($mobile && (!User::checkMobile($mobile,$type))){
                $errorList['mobile'] = "Mobile number is already registered";
            }

            if($username && (!User::checkUsername($username,$type))){
                $errorList['username'] = "Username is not available";
            }

            if(sizeof($errorList) > 0){
                echo json_encode(array(
                    'status' => false,
                    'auth' => false,
                    'message' => 'Please check the errors',
                    'errorList' => $errorList
                ));
                exit();
            }


            $user = SiteManager::getUserInstance();

            $user->setUsername($username);
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setMobile($mobile);
            $user->setEmail($email);
            $user->setType(3);
            $user->setPassword($password);

            $ignoreList = array('id','dateOfBirth','status','gender','searchKeywords');

            if($mobile){
                array_push($ignoreList,'mobile');
            }

            if($lastName){
                array_push($ignoreList,'lastName');
            }


            if($user->save($ignoreList)){
                echo json_encode(array(
                    'status' => true,
                    'auth' => true,
                    'message' => 'User saved successfully',
                    'data' => $user->toJson()
                ));
                exit();
            }

            else{
                echo json_encode(array(
                    'status' => false,
                    'auth' => false,
                    'message' => 'Something went wrong'
                ));
                exit();
            }


            break;
        case 4:
            /**
             * Admin
             */
            break;
        default :
            echo json_encode(array(
                'status' => false,
                'auth' => false,
                'message' => 'Action not applicable'
            ));
            break;
    }
