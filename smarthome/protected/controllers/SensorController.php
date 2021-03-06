<?php

class SensorController extends Controller {

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
		'actions' => array('index', 'view', 'delete'),
		'users' => array('*'),
	    ),
	    array('allow', // allow authenticated user to perform 'create' and 'update' actions
		'actions' => array('create', 'update', 'delete'),
		'users' => array('@'),
	    ),
	    array('allow', // allow admin user to perform 'admin' and 'delete' actions
		'actions' => array('admin'),
		'users' => array('@'),
	    ),
	);
    }

    public function actionIndex() {
	$this->render('index');
    }

    public function actionOne($id) {
	$this->render('show_one', array('id' => $id, 'data' => $this->loadModel($id)));
    }

    //  AJAX
    public function actionSensors() {
	$req = Yii::app()->request;
	$limit = $req->getParam('page') ? $req->getParam('page') : 25;
	$offset = $req->getParam('offset') ? $req->getParam('offset') : 0;
	$sensorData = null;
	try {
	    $cats = array();
	    $sData = Yii::app()->db->createCommand()
		    ->from('sensor')
		    ->leftJoin('sensor_type', 'sensor_type.id=sensor.type')
		    ->leftJoin('measurement', 'measurement.sensor_id=sensor.id')
		    ->where('measurement.sensor=1')
		    ->andWhere('sensor.system_id=' . Yii::app()->session['system_id'])
		    ->order('measurement.id')
		    ->limit($limit, $offset)
		    ->queryAll();
	    foreach ($sData as $oneRead) {
		if (!in_array(array($oneRead['type_name'], $oneRead['sensor_id'], $oneRead['unit'], $oneRead['name']), $cats)) {
		    $cats[] = array($oneRead['type_name'], $oneRead['sensor_id'], $oneRead['unit'], $oneRead['name']);
		}
	    }
	    $sensorData['data'] = $sData;
	    $sensorData['cats'] = $cats;
	    $sensorData['sensor_type_count'] = count($cats);
	}
	catch (Exception $e) {
	    Yii::log("Can't get sensor data:" . $e->getMessage());
	}
	$this->output($sensorData);
    }

    //  AJAX
    public function actionSensor($id) {
	$sensorData = null;
	try {
	    $cats = array();
	    $sData = Yii::app()->db->createCommand()
		    ->from('sensor')
		    ->join('sensor_type', 'sensor_type.id=sensor.type')
		    ->leftJoin('measurement', 'measurement.sensor_id=sensor.id')
		    ->where('sensor.id=' . $id . ' and measurement.sensor=1')
		    ->andWhere('sensor.system_id=' . Yii::app()->session['system_id'])
		    ->order('measurement.id DESC')
		    ->limit(15)
		    ->queryAll();
	    foreach ($sData as $oneRead) {
		if (!in_array(array($oneRead['type_name'], $oneRead['sensor_id'], $oneRead['unit'], $oneRead['name']), $cats)) {
		    $cats[] = array($oneRead['type_name'], $oneRead['sensor_id'], $oneRead['unit'], $oneRead['name']);
		}
	    }
	    $sensorData['data'] = $sData;
	    $sensorData['cats'] = $cats;
	}
	catch (Exception $e) {
	    Yii::log("Can't get sensor data");
	}
	$this->output($sensorData);
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
	$model = new Sensor;

	// Uncomment the following line if AJAX validation is needed
	// $this->performAjaxValidation($model);

	if (isset($_POST['Sensor'])) {
	    $model->attributes = $_POST['Sensor'];
	    if ($model->save())
		$this->redirect(array('view', 'id' => $model->id));
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

	if (isset($_POST['Sensor'])) {
	    $post = $_POST['Sensor'];
	    $model->attributes = $post;
	    if ($model->save(false))
		$this->redirect(array('view', 'id' => $model->id));
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
	$this->redirect($this->createAbsoluteUrl('sensor/list'));
    }

    /**
     * Lists all models.
     */
    public function actionList() {
	$sid = Yii::app()->session['system_id'];

	$qry = Yii::app()->request->getParam('query');
	$qryClean = isset($qry) ? $qry : null;
	$qry = isset($qry) ? $qry : null;

	$criteriaCondition = 'system_id=' . $sid;
	$criteria = new CDbCriteria(['condition' => $criteriaCondition]);
	if (isset($qry)) {
	    $criteria->addCondition("name LIKE '%" . $qry . "%'", 'AND');
	    $criteria->addCondition("com_id LIKE '%" . $qry . "%'", 'OR');
	    $criteria->addCondition("serial LIKE '%" . $qry . "%'", 'OR');
	}

	$dataProvider = new CActiveDataProvider('Sensor', ['criteria' => $criteria,]);
	$this->render(
		'list', array(
	    'dataProvider' => $dataProvider,
	    'qry' => $qryClean,
		)
	);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
	$model = new Sensor('search');
	$model->unsetAttributes();  // clear any default values
	if (isset($_GET['Sensor']))
	    $model->attributes = $_GET['Sensor'];

	$this->render('admin', array(
	    'model' => $model,
	));
    }

    public function getSensorType($data, $row) {
	$result = '';
	try {
	    $type = SensorType::model()->findByPk($data->getAttribute('type'));
	    if (isset($type)) {
		$result = $type->getAttribute('value');
	    }
	}
	catch (Exception $e) {
	    
	}
	return $result;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Sensor the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
	$model = Sensor::model()->findByPk($id);
	if ($model === null)
	    throw new CHttpException(404, 'The requested page does not exist.');
	return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Sensor $model the model to be validated
     */
    protected function performAjaxValidation($model) {
	if (isset($_POST['ajax']) && $_POST['ajax'] === 'sensor-form') {
	    echo CActiveForm::validate($model);
	    Yii::app()->end();
	}
    }

    public function actionDatesearch($offset, $limit) {
	$dateFrom = Yii::app()->request->getPost('date_from');
	$dateFrom = isset($dateFrom) ? $dateFrom : null;
	$dateTo = Yii::app()->request->getPost('date_to');
	$dateTo = isset($dateTo) ? $dateTo : null;
	if (!isset($dateFrom) || !isset($dateTo)) {
	    throw new CHttpException(404, 'The requested page does not exist.');
	}
	$data = [];
	$sData = Yii::app()->db->createCommand()
		->from('sensor')
		->leftJoin('sensor_type', 'sensor_type.id=sensor.type')
		->leftJoin('measurement', 'measurement.sensor_id=sensor.id')
		->where('measurement.sensor=1')
		->andWhere('sensor.system_id=' . Yii::app()->session['system_id'])
		->andWhere("measurement.date_measured>='" . $dateFrom . "'")
		->andWhere("measurement.date_measured<='" . $dateTo . "'")
		->order('measurement.id')
		->limit($limit, $offset)
		->queryAll();
	foreach ($sData as $oneRead) {
	    if (!in_array(array($oneRead['type_name'], $oneRead['sensor_id'], $oneRead['unit'], $oneRead['name']), $data)) {
		$data[] = array($oneRead['type_name'], $oneRead['sensor_id'], $oneRead['unit'], $oneRead['name']);
	    }
	}
    }

}
