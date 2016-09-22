<?php
/**
 * Created by PhpStorm.
 * User: Hemant
 * Date: 16-10-2015
 * Time: 02:32 AM
 */
    class RequestParser{

        private $url = '';
        private $method = null;
        private $isHandlerFound = true;

        public function __construct(){
            if(isset($_REQUEST['page'])){
                $this->url = strtolower($_REQUEST['page']);
            }
            $this->method = strtoupper($_SERVER['REQUEST_METHOD']);
//            var_dump($_SERVER);
//            echo "<br/>";
//            echo "<hr/>";
//            var_dump($_REQUEST);

            if($this->method && $this->url){
                try{
                    if(isset(ConfigurationManager::getControllerMap()[$this->method][$this->url])){
                        require_once ConfigurationManager::getControllerDirectory() .ConfigurationManager::getControllerMap()[$this->method][$this->url];
                    }
                    else{
                        $this->isHandlerFound = false;
                        require_once ConfigurationManager::getControllerDirectory(). ConfigurationManager::getControllerMap()[$this->method]['404'];
                    }
//                    require_once ConfigurationManager::getControllerDirectory() .ConfigurationManager::getControllerMap()[$this->method][$this->url];
                }
                catch(Exception $ex){
                    $this->isHandlerFound = false;
                    require_once ConfigurationManager::getControllerDirectory(). ConfigurationManager::getControllerMap()[$this->method]['404'];
                }
            }
            else if($this->method !== "GET"){

                try{
                    require_once ConfigurationManager::getControllerDirectory(). ConfigurationManager::getControllerMap()['POST']['default'];

                }
                catch(Exception $ex){
                    $this->isHandlerFound = false;
                    require_once ConfigurationManager::getControllerDirectory(). ConfigurationManager::getControllerMap()[$this->method]['404'];
                }

            }
            else{
                try{
                    require_once ConfigurationManager::getControllerDirectory(). ConfigurationManager::getControllerMap()['GET']['default'];
                }
                catch(Exception $ex){
                    $this->isHandlerFound = false;
                    require_once ConfigurationManager::getControllerDirectory(). ConfigurationManager::getControllerMap()['POST']['404'];
                }
            }
        }

        public function getUrl(){
            return $this->url;
        }

        public function getMethod(){
            return $this->method;
        }


        public function getViewDir(){
            if($this->url && $this->isHandlerFound){
                return ConfigurationManager::getViewsDirectory() . rtrim($this->url,'/') . '/';
            }
            else if($this->isHandlerFound){
                return ConfigurationManager::getViewsDirectory() . 'default' . '/';
            }
            else{
                return ConfigurationManager::getViewsDirectory() . '404' . '/';
            }
        }

    }