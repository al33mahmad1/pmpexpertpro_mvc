<?php
    // Requiring Configs
    require_once("config/config.php");

    require_once("helpers/session_helper.php");
    require_once("helpers/url_helpers.php");
    require_once("helpers/helper_functions.php");

    // Load Libraries
    // require_once 'libraries/Core.php';
    // require_once 'libraries/Controller.php';
    // require_once 'libraries/Database.php';

    // require_once 'libraries/sendgrid/autoload.php';

    // Automatic Libraries Loader
    spl_autoload_register(function($className) {
	    require_once 'libraries/'. $className .'.php';    	
    });