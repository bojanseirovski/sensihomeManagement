<?php
include	'funct.php';
$dsn	=	require	dirname(__FILE__)	.	DIRECTORY_SEPARATOR. '..'.	DIRECTORY_SEPARATOR. 'smarthome'.	DIRECTORY_SEPARATOR. 'protected'.	DIRECTORY_SEPARATOR. 'config'.	DIRECTORY_SEPARATOR. 'database.php';

$con=new \PDO($dsn['connectionString'], $dsn['username'], $dsn['password']);

/**
	* Use PDO to read the DB and curl to talk to
	* the devices
	* alert table
	* 
	*/
$sData	=	runQuery($con,	'SELECT * FROM alert;',	null,true);

foreach($sData as $oneModule){
				$oneSensorData	=	runQuery($con,	'SELECT id, serial,com_id FROM sensor WHERE id=:tby;',	array(':tby'=>$oneModule['triggered_by']),true);
				if(!isset($oneSensorData[0])){
								continue;
				}
			 $requestEndPoint = 'http://'.$oneSensorData[0]['com_id']. '/id/'.$oneSensorData[0]['serial'].'/reqtype/json';
				
				$measure = getSimpleRequest($requestEndPoint);
				
				if(isset($measure) && isset($measure['status']) && ($measure['status']=='OK')){
								if(isset($oneModule['value']) && ($oneModule['trigger_value']>=$measure['value'])){
												try{
																// load actuator values
																$requestEndPoint = 'http://'.$oneModule['actuator_id']. '/id/'.$oneModule['serial'].'/reqtype/json/pin/ON';
																$fireAlert = getSimpleRequest($requestEndPoint);
																if($fireAlert['status']!='OK'){
																				error_log('Actuator ID '.$oneModule['actuator_id']." wasn't set.");
																}																
												}
												catch(Exception $e){
																error_log($e->getMessage());
												}
								}
				}
}