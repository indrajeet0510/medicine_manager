<?php

/**
 * Created by PhpStorm.
 * User: Hemant
 * Date: 18-10-2015
 * Time: 01:34 AM
 */
class ConfigurationManager {

    const PROJECT_NAME = "Retalics";
    const SESSION_COOKIE = "sessionId";

    const SITE_FOLDER = "/drug_manager";
    const DIR_VIEW = "views/";
    const DIR_CONTROLLER = "controllers/";
    const SITE_URL = "https://www.retalics.com";

    public static function getControllerMap(){
        return [
            "GET" => [
                "user" => "user/user_list.inc.php",
                "product" => "product/product.inc.php",
                "default" => "default/default.inc.php",
                "404" => "404/404.inc.php"
            ],
            "POST" => [
                "user" => "user/user_save.inc.php",
                "product" => "product/product_save.inc.php",
//                "user_update" => "user/user_update.inc.php",
//                "drug" => "drug/drug_save.inc.php",
//                "patient" => "patient/patient_save.inc.php",
//                "patient_drug" => "patient_drug/patient_drug.inc.php",
                "session" => "session/session.inc.php",
//                "profile_update" => "session/session_update.inc.php",
//                "password_update" => "session/password_update.inc.php",
                "default" => "default/default_post.inc.php",
                "404" => "404/404.inc.php"
            ],
            "PUT" => [
                "404" => "404/404.inc.php"
            ],
            "DELETE" => [
                "session" => "session/session_delete.inc.php",
                "404" => "404/404.inc.php"
            ]
        ];
    }

    public static function getDbSettings(){
        return [
            "DB_HOST" => "localhost",
            "DB_USER" => "root",
            "DB_PASS" => "root",
            "DB_NAME" => "drug_manager",
            "DB_PORT" => 3306,
        ];
    }

    public static function basePath() {
        return rtrim($_SERVER['DOCUMENT_ROOT'],'/') .'/'. 'drug_manager/';
    }

    public static function getViewsDirectory(){
        return self::basePath() . self::DIR_VIEW;
    }
    public static function getControllerDirectory(){
        return self::basePath() . self::DIR_CONTROLLER;
    }

    public static function staticAssetsPath(){
        //var_dump($_SERVER);
        return self::SITE_FOLDER . "/" . "assets/";
    }


}