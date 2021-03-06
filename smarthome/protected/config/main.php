<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'SensiStash',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
	'application.models.*',
	'application.components.*',
    ),
    'modules' => array(
	// uncomment the following to enable the Gii tool
	/*
	 */
	'gii' => array(
	    'class' => 'system.gii.GiiModule',
	    'password' => 'admin',
	    // If removed, Gii defaults to localhost only. Edit carefully to taste.
	    'ipFilters' => array('127.0.0.1', '::1'),
	),
    ),
    // application components
    'components' => array(
	'user' => array(
	    // enable cookie-based authentication
	    'allowAutoLogin' => true,
	),
	// uncomment the following to enable URLs in path-format
	'urlManager' => array(
	    'urlFormat' => 'path',
	    'rules' => array(
		'<controller:\w+>/<id:\d+>' => '<controller>/view',
		'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
		'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
		'<controller:\w+>/datesearch/<offset>/<limit>' => '<controller>/datesearch',
		'search/ssearch/<offset>/<limit>' => 'search/ssearch',
		'search/asearch/<offset>/<limit>' => 'search/asearch',
	    ),
	),
	// database settings are configured in database.php
	'db' => require(dirname(__FILE__) . '/database.php'),
	'errorHandler' => array(
	    // use 'site/error' action to display errors
	    'errorAction' => 'site/error',
	),
	'log' => array(
	    'class' => 'CLogRouter',
	    'routes' => array(
		array(
		    'class' => 'CFileLogRoute',
		    'levels' => 'error, warning, info',
		),
		array(
		    'class' => 'CProfileLogRoute',
		    'categories' => 'system.db.CDbCommand.query',
		    'levels' => 'profile',
		),
	    ),
	),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
	// this is used in contact page
	'adminEmail' => 'webmaster@example.com',
	'req_key' => '8973cn97589n47tpn3bxct7btx8gx4n73',
    ),
);
