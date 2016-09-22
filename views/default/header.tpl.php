<!DOCTYPE html>
<html>
    <head>
        <title>Drug Manager</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo ConfigurationManager::staticAssetsPath() ?>css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo ConfigurationManager::staticAssetsPath() ?>css/custom.min.css" />
        <link rel="stylesheet" href="<?php echo ConfigurationManager::staticAssetsPath() ?>css/app.css" />
        <link rel="stylesheet" href="<?php echo ConfigurationManager::staticAssetsPath() ?>css/token-input.css" />

        <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="<?php echo ConfigurationManager::staticAssetsPath() ?>js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo ConfigurationManager::SITE_FOLDER ?>"><i class="fa fa-medkit"></i> <?php echo ConfigurationManager::PROJECT_NAME ?></a>
            </div>

            <?php
                if(SiteManager::getUserInstance()->getId()):

            ?>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="<?php echo (SiteManager::$page == 'user') ? 'active' : '' ?>"><a href="<?php echo ConfigurationManager::SITE_FOLDER ?>/?page=user">Users</a></li>
                    <li class="<?php echo (SiteManager::$page == 'drug') ? 'active' : '' ?>"><a href="<?php echo ConfigurationManager::SITE_FOLDER ?>/?page=drug">Drugs</a></li>
                    <li class="<?php echo (SiteManager::$page == 'patient') ? 'active' : '' ?>"><a href="<?php echo ConfigurationManager::SITE_FOLDER ?>/?page=patient">Patients</a></li>
                    <li class="<?php echo (SiteManager::$page == 'patient_drug') ? 'active' : '' ?>"><a href="<?php echo ConfigurationManager::SITE_FOLDER ?>/?page=patient_drug">Patient's Drug Records</a></li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="<?php echo (SiteManager::$page == 'session') ? 'active' : '' ?>">
                        <a href="<?php echo ConfigurationManager::SITE_FOLDER ?>/?page=session">
                            <?php echo SiteManager::getUserInstance()->getUsername() ?>
                        </a>
                    </li>
                    <li><a href="<?php echo ConfigurationManager::SITE_FOLDER ?>/?page=session_logout">Logout</a></li>
                </ul>
            </div>
            <?php
                endif;
            ?>
        </div>
    </nav>

