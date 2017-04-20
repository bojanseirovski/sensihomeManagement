<?php

include 'funct.php';

$dsn = [
    'connectionString' => 'mysql:host=localhost;dbname=smarthome',
    'emulatePrepare' => true,
    'username' => 'root',
    'password' => 'rim%@!641',
    'charset' => 'utf8',
];
$mailCreds = [
    'host'=>'',
    'user'=>'',
    'password'=>'',
    'secure'=>'',
    'port'=>'',
    'smtpauth'=>true,
];
$con = new \PDO($dsn['connectionString'], $dsn['username'], $dsn['password']);

/**
 * Use PDO to read the DB and curl to talk to
 * the devices
 * alert table
 * 
 */
$sData = runQuery($con, 'SELECT * FROM alert;', null, true);

$countActivatedDevs = 0;
$notifyBody = [];
foreach ($sData as $oneModule) {
    $notifyAdmin = isset($oneModule['notify']);
    $oneSensorData = runQuery($con, 
	    'SELECT id, serial,com_id, system_id FROM sensor WHERE id=:tby ;', 
	    [':tby' => $oneModule['triggered_by']], 
	    true
    );
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
		    if($notifyAdmin){
			$countActivatedDevs++;
			$notifyBody[] = [
			    'sys'=>$oneSensorData['system_id'],
			    'msg'=>$oneModule['action'].', actuator ' . $oneModule['actuator_id'] . " was set on ".
			    date('d M Y h:i:s')." triggered by sensor ".$oneModule['triggered_by']
			];
		    }
		}
		/**
		 * Log alert execution here
		 */
		//insert alert
		$alertLogQry = "INSERT INTO alert_log(sid, aid, alid, alname, svalue, astate)"
			. " VALUES(:sid, :aid, :alid, :alname, :svalue, :astate);";
		$alertLogData = [
		    ":sid"=>$oneModule['triggered_by'],
		    ":aid"=>$oneModule['actuator_id'],
		    ":alid"=>$oneModule['id'],
		    ":alname"=>$oneModule['action'],
		    ":svalue"=>$oneModule['trigger_value'],
		    ":astate"=>$oneModule['actuator_state'],
		];
		runQuery($con, $alertLogQry, $alertLogData);
	    }
	    catch (Exception $e) {
		error_log($e->getMessage());
	    }
	}
    }
}

/**
 * send email per alert
 */
$users = runQuery($con, 'SELECT * FROM user JOIN user_system ON user.id=user_system.user_id;', null, true);
foreach($users as $oneUser){
    $userMailBody = '';
    if(isset($oneUser['notify'])){
	$sysId = $oneUser['system_id'];
	$countUserData = 0;
	foreach($notifyBody as $oneNotSec){
	    if($oneNotSec['sys']==$sysId){
		$countUserData++;
		$userMailBody .='<div>'.$oneNotSec['msg'].'</div>' ;
	    }
	}
	if($countUserData>0){
	    $recepient = [
		'email'=>$oneUser['username'],
		'name'=>$oneUser['name'],
	    ];
	    //send mail 
	    sendEmail($mailCreds, $recepient, $userMailBody, "SensiStash Notification");
	}
    }
}
