<?php
include	'funct.php';
$dsn	=	array(
				'connectionString'	=>	'mysql:host=localhost;dbname=smarthome',
				'emulatePrepare'	=>	true,
				'username'	=>	'root',
				'password'	=>	'***************',
				'charset'	=>	'utf8',
);


$con=new \PDO($dsn['connectionString'], $dsn['username'], $dsn['password']);

/**
	* Use PDO to read the DB and curl to talk to
	* the devices
	* sensor table
	* 
	*/
$sData	=	runQuery($con,	'SELECT * FROM sensor;',	null,true);

$qry = 'INSERT INTO measurement(sensor_id,value,sensor) VALUES(:sid, :val, 1);';
foreach($sData as $oneModule){
				$requestEndPoint = 'http://'.$oneModule['com_id']. '/id/'.$oneModule['serial'].'/reqtype/json';
				
				$measure = getSimpleRequest($requestEndPoint);
				
				if(isset($measure) && isset($measure['status']) && ($measure['status']=='OK')){
								$measuredValue = isset($measure[$oneModule['value_fields']])?$measure[$oneModule['value_fields']]:null;
								if(isset($measuredValue) && abs($measuredValue)<100){
												try{
																$val = $measuredValue;
																$args = [
																				':sid'=>$oneModule['id'], 
																				':val'=>$val
																];
																runQuery( $con,	$qry, $args);
												}
												catch(Exception $e){
																error_log($e->getMessage());
												}
								}
												
				}
}
