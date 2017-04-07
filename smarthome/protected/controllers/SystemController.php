<?php

class SystemController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
	return array(
	    'accessControl', // perform access control for CRUD operations
	    'postOnly + delete', // we only allow deletion via POST request
	);
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
	return array(
	    array('allow', // allow all users to perform 'index' and 'view' actions
		'actions' => array('index', 'view'),
		'users' => array('*'),
	    ),
	    array('allow', // allow authenticated user to perform 'create' and 'update' actions
		'actions' => array('create', 'update'),
		'users' => array('@'),
	    ),
	    array('allow', // allow admin user to perform 'admin' and 'delete' actions
		'actions' => array('admin', 'delete'),
		'users' => array('admin'),
	    ),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
	);
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
	$this->render('view', array(
	    'model' => $this->loadModel($id),
	));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
	$model = new System;

	// Uncomment the following line if AJAX validation is needed
	// $this->performAjaxValidation($model);

	if (isset($_POST['System'])) {
	    $model->attributes = $_POST['System'];
	    if ($model->save())
		$this->redirect(array('view', 'id' => $model->prim_key));
	}

	$this->render('create', array(
	    'model' => $model,
	));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
	$model = $this->loadModel($id);

	// Uncomment the following line if AJAX validation is needed
	// $this->performAjaxValidation($model);

	if (isset($_POST['System'])) {
	    $model->attributes = $_POST['System'];
	    if ($model->save())
		$this->redirect(array('view', 'id' => $model->prim_key));
	}

	$this->render('update', array(
	    'model' => $model,
	));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
	$this->loadModel($id)->delete();

	// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
	if (!isset($_GET['ajax']))
	    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
	$dataProvider = new CActiveDataProvider('System');
	$this->render('index', array(
	    'dataProvider' => $dataProvider,
	));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
	$model = new System('search');
	$model->unsetAttributes();  // clear any default values
	if (isset($_GET['System']))
	    $model->attributes = $_GET['System'];

	$this->render('admin', array(
	    'model' => $model,
	));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return System the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
	$model = System::model()->findByPk($id);
	if ($model === null)
	    throw new CHttpException(404, 'The requested page does not exist.');
	return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param System $model the model to be validated
     */
    protected function performAjaxValidation($model) {
	if (isset($_POST['ajax']) && $_POST['ajax'] === 'system-form') {
	    echo CActiveForm::validate($model);
	    Yii::app()->end();
	}
    }

    public function actionDiscover() {
	$sysID = System::model()->find()->attributes;
	$response = array(
	    'sensistash' => 'true',
	    'system' => 'Home IOT',
	    'device_key' => md5($sysID['key']),
	);
	$this->output($response);
    }

    public function actionRegisterdevice() {

	$req = Yii::app()->request;

	$type = $req->getParam('type');
	$typeName = $req->getParam('type_name');
	$name = $req->getParam('name');
	$unit = $req->getParam('unit');
	$state = $req->getParam('state');
	$pins = $req->getParam('pins');

	$comm = $_SERVER['REMOTE_ADDR'];

	$output = array('status' => 'error');
	if (isset($type) && isset($typeName)) {
	    //  it's a sensor
	    if (($type == 'S') || ($type == 'H')) {
		if (isset($unit)) {
		    $sensorType = new SensorType();
		    $sensorType->value = strtoupper($type);
		    $sensorType->type_name = strtoupper($typeName);
		    $sensorType->save();

		    $stId = $sensorType->id;

		    $sensor = new Sensor();
		    $sensor->type = $stId;
		    $sensor->unit = $unit;
		    $sensor->name = isset($name) ? $name : 'sensor' . $stId;
		    $sensor->com_id = $comm;
		    $sensor->system_id = Yii::app()->session['system_id'];
		    $sensor->date_created = date('Y-m-d h:i:s');
		    $sensor->value_fields = $pins;
		    $sensor->save();
		    $output['status'] = 'OK';
		    Yii::app()->session['device_registered'] = true;
		    Yii::app()->session['device_name'] = $sensor->name;
		    Yii::app()->session['device_type'] = $sensorType->value;
		    Yii::app()->session['device_id'] = $sensor->id;
		}
		else {
		    Yii::log('Bad request. Device type "' . $type . '" - unit:' . $unit);
		}
	    }
	    if (($type == 'A') || ($type == 'H')) {
		//  it's an actuator
		if (isset($state)) {
		    $actType = new ActuatorType();
		    $actType->value = strtoupper($type);
		    $actType->type_name = strtoupper($typeName);
		    $actType->save();

		    $atId = $actType->id;

		    $actuator = new Actuator();
		    $actuator->type = $atId;
		    $actuator->state = $state;
		    $actuator->name = isset($name) ? $name : 'actuator' . $atId;
		    $actuator->com_id = $comm;
		    $actuator->system_id = Yii::app()->session['system_id'];
		    $actuator->date_created = date('Y-m-d h:i:s');
		    $actuator->value_fields = $pins;
		    $actuator->save();
		    Yii::app()->session['device_registered'] = true;
		    Yii::app()->session['device_name'] = $actuator->name;
		    Yii::app()->session['device_type'] = $actType->value;
		    Yii::app()->session['device_id'] = $actuator->aid;
		    $output['status'] = 'OK';
		}
		else {
		    Yii::log('Bad request. Device type "' . $type . '" - state:' . $state);
		}
	    }
	}
	$this->output($output);
    }

    public function actionAcknewdevice() {
	$output['status'] = 'EMPTY';
	if (Yii::app()->session['device_registered']) {
	    unset(Yii::app()->session['device_registered']);
	    unset(Yii::app()->session['device_name']);
	    unset(Yii::app()->session['device_type']);
	    unset(Yii::app()->session['device_id']);
	    $output['status'] = 'OK';
	}
	$this->output($output);
    }

    public function actionChecknewdevice() {
	$output['status'] = 'EMPTY';
	if (Yii::app()->session['device_registered']) {
	    $output['device_registered'] = Yii::app()->session['device_registered'];
	    $output['device_name'] = Yii::app()->session['device_name'];
	    $output['device_type'] = Yii::app()->session['device_type'];
	    $output['device_id'] = Yii::app()->session['device_id'];
	    $output['status'] = 'OK';
	}
	$this->output($output);
    }

    public function actionRegisterdevicev() {
	$this->render('reg_dev');
    }

    /*     * *
     * 
     * Scan network for devices: {IP}/register/WEB/ip/{IP address}
     * 
     * http://192.168.2.22/register/WEB/ip/192168222
     * 
     * {"id":10271918,"status":"OK","dev_type":"A","type_name":"switch 1"}
     * 
     * find a device with that response and register
     * 
     */

    public function actionScan() {
	/**
	 * USE cURL TO GO THROUGH EVERY IP ADDRESS IN THE NETWORK
	 */
	$serverIp = $_SERVER['REMOTE_ADDR'];
	$explodedIp = explode('.', $serverIp);
	$network = implode('.', array($explodedIp[0], $explodedIp[1], $explodedIp[2], 1));
	$output['status'] = 'ERROR';
	try {
	    for ($i = 1; $i < 255; $i++) {
		$deviceIp = implode('.', array($explodedIp[0], $explodedIp[1], $explodedIp[2], $i));
		$url = 'http://' . $deviceIp . '/register/WEB/ip/' . $explodedIp[0] . $explodedIp[1] . $explodedIp[2] . $i;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		$response = curl_exec($ch);
		$sensorResponse = json_decode($response);
		if (!json_last_error() && isset($sensorResponse->status) && ($sensorResponse->status == "OK")) {
		    if (($sensorResponse->dev_type == "A") || ($sensorResponse->dev_type == "H")) {
			$actType = new ActuatorType();
			$actType->value = strtoupper($sensorResponse->dev_type);
			$actType->type_name = strtoupper($sensorResponse->type_name);
			$actType->save();

			$atId = $actType->id;

			$actuator = new Actuator();
			$actuator->type = $atId;
			$actuator->state = isset($sensorResponse->state) ? $sensorResponse->state : 'OFF';
			$actuator->name = isset($sensorResponse->type_name) ? $sensorResponse->type_name : 'actuator' . $atId;
			$actuator->com_id = $deviceIp;
			$actuator->system_id = Yii::app()->session['system_id'];
			$actuator->date_created = date('Y-m-d h:i:s');
			$actuator->value_fields = $sensorResponse->value_fields;
			$actuator->serial = $sensorResponse->serial;
			$actuator->save();
		    }
		    if (($sensorResponse->dev_type == "S") || ($sensorResponse->dev_type == "H")) {

			$sensorType = new SensorType();
			$sensorType->value = strtoupper($sensorResponse->dev_type);
			$sensorType->type_name = strtoupper($sensorResponse->type_name);
			$sensorType->save();

			$stId = $sensorType->id;

			$sensor = new Sensor();
			$sensor->type = $stId;
			$sensor->unit = isset($sensorResponse->unit) ? $sensorResponse->unit : "";
			$sensor->name = isset($sensorResponse->type_name) ? $sensorResponse->type_name : 'sensor' . $stId;
			$sensor->com_id = $deviceIp;
			$sensor->system_id = Yii::app()->session['system_id'];
			$sensor->date_created = date('Y-m-d h:i:s');
			$sensor->value_fields = $sensorResponse->value_fields;
			$sensor->serial = $sensorResponse->serial;
			$sensor->save();
		    }
		}
	    }
	    $output['status'] = 'OK';
	}
	catch (Exception $e) {
	    $output['status'] = 'ERROR';
	}
	$this->output($output);
    }

    public function actionUsersumary() {
	$req = Yii::app()->request;

	$limit = $req->getParam('limit') ? $req->getParam('limit') : 25;
	$offset = $req->getParam('offset') ? $req->getParam('offset') : 0;
	$serverIp = $_SERVER['REMOTE_ADDR'];

	$countSensors = Yii::app()->db->createCommand()
		->from('sensor')
		->where('system_id=' . Yii::app()->session['system_id'])
		->limit($limit, $offset)
		->queryAll();

	$countActuators = Yii::app()->db->createCommand()
		->from('actuator')
		->where('system_id=' . Yii::app()->session['system_id'])
		->limit($limit, $offset)
		->queryAll();

	$this->render(
		'sumary', array(
	    'serverIp' => $serverIp,
	    'sensorCount' => $countSensors,
	    'actuatorCount' => $countActuators
		)
	);
    }

    public function actionGetalldata() {
	//get sensors,
	//get actuators
	$output['status'] = 'ERROR';
	$sData = Yii::app()->db->createCommand()
		->select(array('id', 'com_id', 'system_id', 'value_fields', 'serial'))
		->from('sensor')
		->where('sensor.system_id=' . Yii::app()->session['system_id'])
		->queryAll();
	$aData = Yii::app()->db->createCommand()
		->select(array('aid', 'com_id', 'system_id', 'value_fields', 'serial'))
		->from('actuator')
		->where('actuator.system_id=' . Yii::app()->session['system_id'])
		->queryAll();

	try {
	    foreach ($sData as $oneSensor) {
		$deviceIp = $oneSensor['com_id'];
		$url = 'http://' . $deviceIp . '/id/' . $oneSensor['serial'] . '/reqtype/json/';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 90);
		curl_setopt($ch, CURLOPT_TIMEOUT, 90);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		$response = curl_exec($ch);
		$sensorResponse = json_decode($response);
		if (!json_last_error() && isset($sensorResponse->status) && ($sensorResponse->status == "OK")) {
		    //  save data in measurement, for valiue_fields (same device, 2 records)
		    $twoPins = explode(',', $oneSensor['value_fields']);
		    foreach ($twoPins as $pin) {
			if (isset($sensorResponse->$pin)) {
			    $measure = new Measurement;
			    $measure->setAttribute('sensor_id', $oneSensor['id']);
			    $measure->setAttribute('value', $sensorResponse->$pin);
			    $measure->setAttribute('sensor', 1);
			    $measure->setAttribute('date_measured', time());
			    $measure->setAttribute('message', '***');

			    $measure->save();
			}
		    }
		}
	    }
	    foreach ($aData as $oneActuator) {
		$deviceIp = $oneActuator['com_id'];
		$url = 'http://' . $deviceIp . '/id/' . $oneActuator['serial'] . '/reqtype/json';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		$response = curl_exec($ch);
		$oneActuatorResponse = json_decode($response);
		if (!json_last_error() && isset($oneActuatorResponse->status) && ($oneActuatorResponse->status == "OK")) {
		    //  save data in measurement, for valiue_fields (same device, 2 records)
		    $twoPins = explode(',', $oneSensor['value_fields']);
		    foreach ($twoPins as $pin) {
			if (isset($sensorResponse->$pin)) {
			    $measure = new Measurement;
			    $measure->setAttribute('sensor_id', $oneActuator['aid']);
			    $measure->setAttribute('value', $sensorResponse->$pin);
			    $measure->setAttribute('sensor', 0);
			    $measure->setAttribute('date_measured', time());
			    $measure->setAttribute('message', '***');

			    $measure->save();
			}
		    }
		}
	    }
	    $output['status'] = 'OK';
	}
	catch (Exception $e) {
	    $output['status'] = 'ERROR';
	}
	$this->output($output);
    }

    public function actionGetdata($id, $type) {
	//get sensors,
	//get actuators
	$output['status'] = 'ERROR';
	if (!isset($type)) {
	    $this->output($output);
	}

	try {
	    if ($type == 'S') {
		$sData = Yii::app()->db->createCommand()
			->select(array('id', 'com_id', 'system_id', 'value_fields', 'serial'))
			->from('sensor')
			->where('sensor.system_id=' . Yii::app()->session['system_id'])
			->queryAll();

		foreach ($sData as $oneSensor) {
		    $deviceIp = $oneSensor['com_id'];
		    $url = 'http://' . $deviceIp . '/register/WEB/id/' . $oneSensor['serial'] . '/reqtype/json';
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		    $response = curl_exec($ch);
		    $sensorResponse = json_decode($response);
		    if (!json_last_error() && isset($sensorResponse->status) && ($sensorResponse->status == "OK")) {
			//  save data in measurement, for valiue_fields (same device, 2 records)
			$twoPins = explode(',', $oneSensor['value_fields']);
		    }
		}
	    }
	    if ($type == 'A') {
		$aData = Yii::app()->db->createCommand()
			->select(array('aid', 'com_id', 'system_id', 'value_fields', 'serial'))
			->from('actuator')
			->where('actuator.system_id=' . Yii::app()->session['system_id'])
			->queryAll();
		foreach ($aData as $oneActuator) {
		    $deviceIp = $oneActuator['com_id'];
		    $url = 'http://' . $deviceIp . '/register/WEB/id/' . $oneActuator['serial'] . '/reqtype/json';
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		    $response = curl_exec($ch);
		    $oneActuatorResponse = json_decode($response);
		    if (!json_last_error() && isset($oneActuatorResponse->status) && ($oneActuatorResponse->status == "OK")) {
			//  save data in measurement, for valiue_fields (same device, 2 records)
		    }
		}
	    }
	    $output['status'] = 'OK';
	}
	catch (Exception $e) {
	    $output['status'] = 'ERROR';
	}
	$this->output($output);
    }

    public function actionSetdata() {
	$req = Yii::app()->request;
	$type = $req->getParam('type');
	$serial = $req->getParam('serial');
	$field = $req->getParam('field');
	$value = $req->getParam('value');

	$output['status'] = 'ERROR';
	if (!isset($type) || !isset($serial) || !isset($field) || !isset($value)) {
	    $this->output($output);
	}
	$today = date('Y-m-d h:i:s');
	try {
	    if ($type == 'S') {
		//find by serial  get ID
		//  save value
		$device = Sensor::model()->findByAttributes(array('serial' => $serial));
		$measure = new Measurement;
		$measure->setAttribute('sensor_id', $device['id']);
		$measure->setAttribute('value', $value);
		$measure->setAttribute('sensor', 1);
		$measure->setAttribute('date_measured', $today);
		$measure->setAttribute('message', '***');

		$measure->save();
	    }
	    if ($type == 'A') {
		$device = Actuator::model()->findByAttributes(array('serial' => $serial));
		$measure = new Measurement;
		$measure->setAttribute('sensor_id', $device['aid']);
		$measure->setAttribute('value', $value);
		$measure->setAttribute('sensor', 1);
		$measure->setAttribute('date_measured', $today);
		$measure->setAttribute('message', '***');

		$measure->save();
	    }
	    $output['status'] = 'OK';
	}
	catch (Exception $e) {
	    $output['status'] = 'ERROR';
	}
	$this->output($output);
    }

    /**
     * get a list of all devices that are registered with this system
     * needs a key (req_key under params)
     *  http://baseurl.com/system/devlist?key=XXXXXXXXXXXXXXXXXXXXXXXXX
     */
    public function actionDevList() {
	$req = Yii::app()->request;
	$key = $req->getParam('key');
	$filter = $req->getParam('filter');

	$thisKey = Yii::app()->params['req_key'];
	$devList = ["status" => "ERROR"];
	$sList = [];
	$aList = [];
	if (isset($key) && ($key == $thisKey)) {
	    $devList["status"] ="OK";
	    if (!isset($filter)) {
		if (($filter == 's') || !isset($filter)) {
		    $sList = Sensor::model()->findAll();
		    foreach ($sList as $oneS) {
			$devList['device'][] = ['id' => $oneS['id'], 'name' => $oneS['name'], 'type' => 's'];
		    }
		}
		if (($filter == 'a' ) || !isset($filter)) {
		    $aList = Actuator::model()->findAll();
		    foreach ($aList as $oneA) {
			$devList['device'][] = ['id' => $oneA['aid'], 'name' => $oneA['name'], 'type' => 'a'];
		    }
		}
	    }
	}
	$this->output($devList);
    }

    /**
     * Get the latest measurement for a device that belongs to this system
     * needs a key (req_key under params)
     *  http://baseurl.com/system/devlist?key=XXXXXXXXXXXXXXXXXXXXXXXXX
     */
    public function actionGetdevval() {
	$req = Yii::app()->request;
	$key = $req->getParam('key');
	$thisKey = Yii::app()->params['req_key'];
	$devId = $req->getParam('id');
	$devList = ["status" => "ERROR"];
	if (isset($key) && ($key == $thisKey)) {
	    $devList["status"] ="OK";
	    $criteria = new CDbCriteria();
	    $criteria->condition = "sensor_id=" . $devId;
	    $criteria->order = "id DESC";
	    $criteria->limit = 1;

	    $latestMeasure = Measurement::model()->find($criteria)->attributes;
	    $devList['device'] = $latestMeasure;
	}
	$this->output($devList);
    }

}
