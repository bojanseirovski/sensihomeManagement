<?php
include	'funct.php';
$dsn	=	array(
				'connectionString'	=>	'mysql:host=localhost;dbname=smarthome',
				'emulatePrepare'	=>	true,
				'username'	=>	'root',
				'password'	=>	'rim%@!641',
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
var_export($qry);
foreach($sData as $oneModule){
				$requestEndPoint = 'http://'.$oneModule['com_id']. '/id/'.$oneModule['serial'].'/reqtype/json';
				
				$measure = getSimpleRequest($requestEndPoint);
				
				if(isset($measure) && isset($measure['status']) && ($measure['status']=='OK')){
								var_export($oneModule);
								var_export($measure);
								var_export($measure[$oneModule['value_fields']]);
								
								
								if(isset($measure[$oneModule['value_fields']])){
												try{
																$val = $measure[$oneModule['value_fields']];
																$args = [
																				':sid'=>$oneModule['id'], 
																				':val'=>$val
																];
																
																runQuery( $con,	$qry, $args);
																
																var_export($args);
												}
												catch(Exception $e){
																error_log($e->getMessage());
												}
								}
												
				}
}
