<?php

class Session
{
    private $user;
    private $id;
    private $sessionId;
    private $status;

    public function setUser($user){
        if($user){
            $this->user = $user;
            return true;
        }
        else{
            return false;
        }
    }

    public function setSessionId($sessionId){
        if($sessionId){
            $this->sessionId = $sessionId;
            return true;
        }
        else{
            return false;
        }
    }

    public function setStatus($status){
        if($status){
            $this->status = $status;
            return true;
        }
        else{
            return false;
        }
    }

    public function getUser(){
        return $this->user;
    }

    public function getId(){
        return $this->id;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getSessionId(){
        return $this->sessionId;
    }

    public function toJson(){
        $jsonSession = [];

        if($this->id){
            foreach($this as $key => $value){
                $ignoreList = array('id','user','status');
                if(!in_array($key,$ignoreList)){
                    $jsonSession[$key] = $value;
                }
            }
            return $jsonSession;
        }
        else{
            return null;
        }
    }

    public function check(){
        if(isset($_GET[ConfigurationManager::SESSION_COOKIE])){
            $this->sessionId = $_GET[ConfigurationManager::SESSION_COOKIE];
            $db = SiteManager::getDBInstance();
            $sql = "SELECT * FROM session WHERE sessionId = '::sessionId' AND status = 1 LIMIT 1";
            $args = array('::sessionId' => $this->sessionId);

            $rs = $db->query($sql, $args);
            if($rs && $rs->num_rows > 0){
                $csession = $db->fetchObject($rs);
                if (isset($csession->id))
                {
                    $this->id = $csession->id;
                    $this->user = $csession->user;
                    $this->sessionId = $csession->sessionId;
                    $this->status = $csession->status;
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else{
                return false;
            }
        } else if(isset($_COOKIE[ConfigurationManager::SESSION_COOKIE])){
            $this->sessionId = $_COOKIE[ConfigurationManager::SESSION_COOKIE];
            $db = SiteManager::getDBInstance();
            $sql = "SELECT * FROM session WHERE sessionId = '::sessionId' AND status = 1 LIMIT 1";
            $args = array('::sessionId' => $this->sessionId);

            $rs = $db->query($sql, $args);
            if($rs && $rs->num_rows > 0) {
                $csession = $db->fetchObject($rs);
                if (isset($csession->id)) {
                    $this->id = $csession->id;
                    $this->user = $csession->user;
                    $this->sessionId = $csession->sessionId;
                    $this->status = $csession->status;
                    return true;
                } else {
                    return false;
                }
            }
            else{
                return false;
            }
        }

    }

    public function load(){
        $db = SiteManager::getDBInstance();
        $sql = "SELECT * FROM session WHERE id = '::id' AND status = 1 LIMIT 1";
        $args = array('::id' => $this->id);

        $rs = $db->query($sql, $args);
        if($rs && $rs->num_rows > 0) {
            $csession = $db->fetchObject($rs);
//            var_dump($csession);
            if (isset($csession->id)) {
                $this->id = $csession->id;
                $this->user = $csession->user;
                $this->sessionId = $csession->sessionId;
                $this->status = $csession->status;
                return true;
            } else {
                return false;
            }
        }
        else {
            return false;
        }
    }


    public function start(){
        $db = SiteManager::getDBInstance();
        $args = array('::user' => $this->user);
        $sql = "INSERT INTO session (user,sessionId) VALUES('::user',UUID())";

        if($db->query($sql,$args)){
            $this->id = $db->lastInsertId();

            if($this->load()){

                setcookie(ConfigurationManager::SESSION_COOKIE, $this->sessionId);
                return $this->sessionId;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }


    public function login($loginId,$password,$type){
        if($loginId && $password){

            $user = User::findUserForLogin($loginId,$type);
            if($user && $user->getId() && $user->getPassword() === User::hashPassword($password)){
                $this->setUser($user->getId());
                return $this->start();
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function logout(){
        if(isset($_COOKIE[ConfigurationManager::SESSION_COOKIE])) {
            $this->sessionId = $_COOKIE[ConfigurationManager::SESSION_COOKIE];
            $db = SiteManager::getDBInstance();
            $sql = "UPDATE session SET status = 0 WHERE sessionId = '::sessionId' AND status = 1 LIMIT 1";
            $args = array('::sessionId' => $this->sessionId);
            if($db->query($sql, $args)){
                setcookie(ConfigurationManager::SESSION_COOKIE);
                return true;
            }
            else{
                setcookie(ConfigurationManager::SESSION_COOKIE);
                return true;
            }
        }
        else if(isset($_GET[ConfigurationManager::SESSION_COOKIE])) {
            $this->sessionId = $_GET[ConfigurationManager::SESSION_COOKIE];
            $db = SiteManager::getDBInstance();
            $sql = "UPDATE session SET status = 0 WHERE sessionId = '::sessionId' AND status = 1 LIMIT 1";
            $args = array('::sessionId' => $this->sessionId);
            if($db->query($sql, $args)){
                setcookie(ConfigurationManager::SESSION_COOKIE);
                return true;
            }
            else{
                setcookie(ConfigurationManager::SESSION_COOKIE);
                return true;
            }
        }
        else{
            return true;
        }
    }

}