<?php
include	'funct.php';
$dsn	=	require	dirname(__FILE__)	.	DIRECTORY_SEPARATOR. '..'.	DIRECTORY_SEPARATOR. 'smarthome'.	DIRECTORY_SEPARATOR. 'protected'.	DIRECTORY_SEPARATOR. 'config'.	DIRECTORY_SEPARATOR. 'database.php';

$con=new \PDO($dsn['connectionString'], $dsn['username'], $dsn['password']);

/**
	* Use PDO to read the DB and curl to talk to
	* the devices
	* sensor table
	* 
	*/
$sData	=	runQuery($con,	'SELECT * FROM sensor;',	null,true);

foreach($sData as $oneModule){
				$requestEndPoint = 'http://'.$oneModule['com_id']. '/id/'.$oneModule['serial'].'/reqtype/json';
				
				$measure = getSimpleRequest($requestEndPoint);
				
				if(isset($measure) && isset($measure['status']) && ($measure['status']=='OK')){
								if(isset($oneModule['value'])){
												try{
																runQuery(
																								$con,	
																								'INSERT INTO measurement(sensor_id,value,sensor) VALUES(:sid, :val, 1);', 
																								array(':sid'=>$oneModule['id'], ':val'=>$measure['value'])
																);
												}
												catch(Exception $e){
																error_log($e->getMessage());
												}
								}
												
				}
}
