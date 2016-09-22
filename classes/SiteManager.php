<?php
/**
 * Created by PhpStorm.
 * User: Hemant
 * Date: 16-10-2015
 * Time: 02:19 AM
 */

    class SiteManager{

        private static $dbConn = null;
        private static $requestParser = null;
        private static $user = null;
        private static $session = null;
        public static $htmlPage = null;
        public static $page = null;

        public static function getPage(){
            if(isset($_REQUEST['page'])){
                self::$page = $_REQUEST['page'];
            }
        }

        public static function getDBInstance(){
            if(self::$dbConn){
                return self::$dbConn;
            }
            else{
                self::$dbConn = new DBManager();
            }
            return self::$dbConn;
        }

        public static function getRequestParserInstance(){
            if(self::$requestParser){
                return self::$requestParser;
            }
            else{
                self::$requestParser = new RequestParser();
            }
            return self::$requestParser;
        }

        public static function getUserInstance(){
            if(self::$user){
                return self::$user;
            }
            else{
                self::$user = new User();
            }
            return self::$user;
        }

        public static function getSessionInstance(){
            if(self::$session){
                self::getUserInstance();
                return self::$session;
            }
            else{
                self::$session = new Session();
                self::$session->check();
                if(self::$session->getId()){
                    $user = self::getUserInstance();
                    $user->setId(self::$session->getUser());
                }
            }
            return self::$session;
        }

//        private $dbConn = null;
//        private $requestParser = null;
//        private $user = null;


//        private function __construct(){
////            $this->dbConn = new DBManager();
////            $this->requestParser = new RequestParser();
////            $this->session = new Session();
////            $this->session->check();
//        }

//        public static function getInstance(){
//            if(null == self::$siteManager){
//                self::$siteManager = new SiteManager();
//            }
//            return self::$siteManager;
//        }
//
//        public function setUser($user){
//            $this->user = $user;
//            return true;
//        }
//
//        public function getUser(){
//            if($this->user instanceof User){
//                return $this->user;
//            }
//            else{
//                return null;
//            }
//        }


//        public function getDB(){
//            if(!$this->dbConn){
//                $this->dbConn = new DBManager(ConfigurationManager::getDbSettings());
//            }
//            return $this->dbConn;
//        }
//
//        public function getRequestParser(){
//            if(!$this->requestParser){
//                $this->requestParser = new RequestParser();
//            }
//            return $this->requestParser;
//        }

        public static function getHtmlPage(){
            return self::$htmlPage;
        }

        public static function setHtmlPage($html){
            self::$htmlPage = $html;

        }

    }