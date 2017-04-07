<?php
include 'funct.php';
include './phpmailer/PHPMailerAutoload.php';

$mailSettings = [
    'host'=>'smtp.gmail.com',
    'port'=>587,
    'username'=>"cablescalc@gmail.com",
    'password'=>"rim%@!641",
    'name'=>"SensiHome Alert",
    'subject'=>'SensiHome Alert - automated action',
];

$dsn = array(
    'connectionString' => 'mysql:host=localhost;dbname=smarthome',
    'emulatePrepare' => true,
    'username' => 'root',
    'password' => 'rim%@!641',
    'charset' => 'utf8',
);

$con = new \PDO($dsn['connectionString'], $dsn['username'], $dsn['password']);


/**
 * Use PDO to read the DB and curl to talk to
 * the devices
 * alert table
 * 
 */
$users = runQuery($con, 'SELECT username, name FROM user;', null, true);
$sData = runQuery($con, 'SELECT * FROM alert;', null, true);

foreach ($sData as $oneModule) {
    $oneSensorData = runQuery($con, 'SELECT id, serial,com_id, name FROM sensor WHERE id=:tby;', array(':tby' => $oneModule['triggered_by']), true);
    $oneActData = runQuery($con, 'SELECT aid, serial,com_id, name FROM actuator WHERE aid=:aid;', array(':aid' => $oneModule['actuator_id']), true);
    if (!isset($oneSensorData[0])) {
	continue;
    }
    $requestEndPoint = 'http://' . $oneSensorData[0]['com_id'] . '/id/' . $oneSensorData[0]['serial'] . '/reqtype/json';

    $measure = getSimpleRequest($requestEndPoint);

    if (isset($measure) && isset($measure['status']) && ($measure['status'] == 'OK')) {
	if (isset($oneModule['value']) && ($oneModule['trigger_value'] >= $measure['value'])) {
	    try {
		// load actuator values
		$requestEndPoint = 'http://' . $oneModule['actuator_id'] . '/id/' . $oneModule['serial'] . '/reqtype/json/pin/ON';
		$fireAlert = getSimpleRequest($requestEndPoint);
		if ($fireAlert['status'] != 'OK') {
		    error_log('Actuator ID ' . $oneModule['actuator_id'] . " wasn't set.");
		}
		else{
		    foreach($users as $oneUser){
			$content = 'Actuator ' . $oneActData['name'] . " was activated by sensor ".$oneSensorData['name'].".";
			sendMail($mailSettings, $oneUser, $content);
		    }
		}
	    }
	    catch (Exception $e) {
		error_log($e->getMessage());
	    }
	}
    }
}
