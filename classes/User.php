<?php

    class User{
        private $id;
        private $username;
        private $email;
        private $password;

        private $type;

        private $firstName;
        private $lastName;
        private $dateOfBirth;
        private $gender;
        private $mobile;

        private $status;
        private $searchKeywords;



        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
            return true;
        }

        public function getUsername(){
            return $this->username;
        }

        public function setUsername($username){
            $this->username = $username;
            return true;
        }

        public function setPassword($password){
            $this->password = $password;
            if($this->password){
                return true;
            }
            else{
                return false;
            }
        }

        public function setPasswordEncrypted($password){
            $this->password = User::hashPassword($password);
            if($this->password){
                return true;
            }
            else{
                return false;
            }
        }

        public function getPassword(){
            return $this->password;
        }

        public function setType($type){
            $this->type = $type;
            return true;
        }

        public function getType(){
            return $this->type;
        }

        public function setFirstName($firstName){
            $this->firstName = $firstName;
            return true;
        }

        public function setLastName($lastName){
            $this->lastName = $lastName;
            return true;
        }

        public function getFirstName(){
            return $this->firstName;
        }

        public function getLastName(){
            return $this->lastName;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
            return true;
        }

        public function setGender($gender){
            $this->gender = $gender;
            return true;
        }

        public function getGender(){
            return $this->gender;
        }

        public function setMobile($mobile){
            $this->mobile = $mobile;
            return true;
        }

        public function getMobile(){
            return $this->mobile;
        }

        public function setDateOfBirth($dateOfBirth){
            $this->dateOfBirth = $dateOfBirth;
            return true;
        }

        public function getDateOfBirth(){
            return $this->dateOfBirth;
        }

        public function getStatus(){
            return $this->status;
        }

        public function setStatus($status){
            $this->status = $status;
            return true;
        }

        public function getSearchKeywords(){
            return $this->searchKeywords;
        }

        public function setSearchKeywords($searchKeywords){
            $this->searchKeywords = $searchKeywords;
            return true;
        }


        public function toJson(){
            $jsonUser = array();
            if($this->id){
                $ignoreList = array('password');
                foreach($this as $key=>$value){

                    if(!in_array($key,$ignoreList)){
                        $jsonUser[$key] = $value;
                    }
                }

                if($this->getType() == 2){
                    $merchant = new Merchant();
                    if($merchant->loadByUser($this->id)){
                        $jsonMerchant = $merchant->toJson();
                        //// var_dump($jsonMerchant);
                        if(is_array($jsonMerchant)){
                            $jsonUser = array_merge($jsonUser,$jsonMerchant);
                        }
                    }

                }
                return $jsonUser;
            }
            return null;
        }

        public function load(){
            $db = SiteManager::getDBInstance();
            $args = array("::id" => $this->id);
            $sql = "SELECT * FROM user u WHERE id='::id' LIMIT 1";
            $rs = $db->query($sql, $args);
            $cuser = $db->fetchObject($rs);
            if (isset($cuser->id))
            {
                $this->setId($cuser->id);
                $this->setUsername($cuser->username);
                $this->setEmail($cuser->email);
                $this->setMobile($cuser->mobile);
                $this->setPassword($cuser->password);
                $this->setFirstName($cuser->firstName);
                $this->setLastName($cuser->lastName);
                $this->setType($cuser->type);
                $this->setDateOfBirth($cuser->dateOfBirth);
                $this->setStatus($cuser->status);
                $this->setSearchKeywords($cuser->searchKeywords);
                $this->setGender($cuser->gender);

                return true;
            }
            else
            {
                return false;
            }
        }

        public function save($ignoreList){
            $db = SiteManager::getDBInstance();
            $args = array(
                "::id" => $this->id,
                "::username" => $this->username,
                "::email" => $this->email,
                "::mobile" => $this->mobile,
                "::password"=> User::hashPassword($this->password),
                "::firstName" => $this->firstName,
                "::lastName" => $this->lastName,
                "::type"=> $this->type,
                "::dateOfBirth" => $this->dateOfBirth,
                "::gender" => $this->gender,
                "::status" => $this->status,
                "::searchKeywords" => $this->searchKeywords
            );
            if($this->id){

                $sql = "UPDATE user SET ";
                foreach($args as $key=>$value){
                    $ignoreList = (count($ignoreList) > 0) ? $ignoreList : array('id');
                    if(!in_array(str_replace('::', '',$key),$ignoreList)){
                        $sql .= str_replace('::', '',$key) . "'" . $key . "', ";
                    }
                }

                $sql = substr($sql,0,(strlen($sql) - 1));
                $sql .= " WHERE id = '::id'";

//                $sql = "UPDATE user SET username = '::username',password = '::password',".
//                    "first_name = '::first_name',last_name = '::last_name',access = '::access' WHERE id = '::id'";
                if($db->query($sql,$args)){
                    return true;
                }
                else{
                    return false;
                }

            }
            else{

                $sql = "INSERT INTO user ";
                $subSql1 = "";
                $subSql2 = "";
                foreach($args as $key=>$value){
                    $ignoreList = (count($ignoreList) > 0) ? $ignoreList : array('id');
                    if(!in_array(str_replace('::', '',$key),$ignoreList)){
                        $subSql1 .= (str_replace('::', '',$key) . ",");
                        $subSql2 .= ("'".$key . "',");
                    }

                }

                $subSql1 = substr($subSql1,0,(strlen($subSql1) - 1));
                $subSql2 = substr($subSql2,0,(strlen($subSql2) - 1));

                $sql = $sql . "(" . $subSql1 . ") VALUES(" . $subSql2 . ") ";

//                $sql = "INSERT INTO user(username,password,first_name,last_name,access) VALUES('::username','::password','::first_name','::last_name','::access')";
                if($db->query($sql,$args)){
                    $this->id = $db->lastInsertId();
                    return true;
                }
                else{
                    return false;
                }
            }
        }

        public static function hashPassword($password){
            if($password){
                return sha1($password);
            }
            else{
                return false;
            }
        }



        public static function checkUsername($username,$type){
            $db = SiteManager::getDBInstance();
            $args = array('::username'=> $username, '::type' => $type);

            $sql = "SELECT * FROM user WHERE username = '::username' AND type = '::type'";
            $res = $db->query($sql,$args);
            // var_dump($res);
            if($res && $res->num_rows > 0){
                return false;
            }
            else{
                return true;
            }
        }

        public static function checkMobile($mobile,$type){
            $db = SiteManager::getDBInstance();
            $args = array('::mobile'=> $mobile, '::type' => $type);

            $sql = "SELECT * FROM user WHERE mobile = '::mobile' AND type = '::type'";
            $res = $db->query($sql,$args);
            // var_dump($res);
            if($res && $res->num_rows > 0){
                return false;
            }
            else{
                return true;
            }
        }

        public static function checkEmail($email,$type){
            $db = SiteManager::getDBInstance();
            $args = array('::email'=> $email, '::type' => $type);

            $sql = "SELECT * FROM user WHERE email = '::email' AND type = '::type'";
            $res = $db->query($sql,$args);
            // var_dump($res);
            if($res && $res->num_rows > 0){
                return false;
            }
            else{
                return true;
            }
        }


        /**
         * @param $loginId
         * @param $type
         * @return null|User
         */
        public static function findUserForLogin($loginId,$type){
            $db = SiteManager::getDBInstance();
            $args = array('::loginId'=> $loginId, '::type' => $type);

            $sql = "SELECT * FROM user WHERE (mobile = '::loginId' OR username = '::loginId' OR email = '::loginId') AND type = '::type' AND status = 1 LIMIT 1";
            $res = $db->query($sql,$args);

            if($res && $res->num_rows > 0) {
                $cuser = $db->fetchObject($res);
                if (isset($cuser->id))
                {
                    $user = new User();
                    $user->setId($cuser->id);
                    $user->setUsername($cuser->username);
                    $user->setEmail($cuser->email);
                    $user->setMobile($cuser->mobile);
                    $user->setPassword($cuser->password);
                    $user->setFirstName($cuser->firstName);
                    $user->setLastName($cuser->lastName);
                    $user->setType($cuser->type);
                    $user->setDateOfBirth($cuser->dateOfBirth);
                    $user->setStatus($cuser->status);
                    $user->setSearchKeywords($cuser->searchKeywords);
                    $user->setGender($cuser->gender);

                    return $user;
                }
                else{
                    return null;
                }
            }


            else
            {
                return null;
            }
        }
    }