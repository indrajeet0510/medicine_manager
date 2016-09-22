<?php
/**
 * Created by PhpStorm.
 * User: Hemant
 * Date: 16-10-2015
 * Time: 02:15 AM
 */

    session_start();

    $baseDirPath = 'drug_manager/';


//var_dump($_REQUEST['page']);

    require_once $_SERVER['DOCUMENT_ROOT'].'/'.$baseDirPath.'interfaces/Database.php';

    require_once $_SERVER['DOCUMENT_ROOT'].'/'.$baseDirPath.'classes/ConfigurationManager.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/'.$baseDirPath.'classes/System.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/'.$baseDirPath.'classes/RequestParser.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/'.$baseDirPath.'classes/SiteManager.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/'.$baseDirPath.'classes/DBManager.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/'.$baseDirPath.'classes/User.php';
//    require_once $_SERVER['DOCUMENT_ROOT'].'/'.$baseDirPath.'classes/Drug.php';
//    require_once $_SERVER['DOCUMENT_ROOT'].'/'.$baseDirPath.'classes/Patient.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/'.$baseDirPath.'classes/Session.php';
//    require_once $_SERVER['DOCUMENT_ROOT'].'/'.$baseDirPath.'classes/PatientDrugManager.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/'.$baseDirPath.'classes/Merchant.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/'.$baseDirPath.'classes/Template.php';

    require_once $_SERVER['DOCUMENT_ROOT'].'/'.$baseDirPath.'config/bootstrap.php';

