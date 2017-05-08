<?php

class AlertController extends Controller {

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
                'actions' => array('create', 'update', 'delete'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin'),
                'users' => array('admin'),
            )
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
        $model = new Alert;

        if (isset($_POST['Alert'])) {
            $model->attributes = $_POST['Alert'];
	    if(!isset($_POST['Alert']['notify'])){
		$model->notify = null;
	    }
            if ($model->save(false)){
                $this->redirect(array('view', 'id' => $model->id));
	    }
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
        if (isset($_POST['Alert'])) {
            $model->attributes = $_POST['Alert'];
	    if(!isset($_POST['Alert']['notify'])){
		$model->notify = null;
	    }
            if ($model->save(false)){
                $this->redirect(array('view', 'id' => $model->id));
	    }
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
        $this->redirect($this->createAbsoluteUrl('/alert/index'));
    }

    public function actionList() {
        $sid = Yii::app()->session['system_id'];
        $qry = Yii::app()->request->getParam('query');
        $qryClean = isset($qry) ? $qry : null;
        $qry = isset($qry) ? $qry : null;

        $criteria = new CDbCriteria();
        if (isset($qry)) {
            $criteria->addCondition("action LIKE '%" . $qry . "%'");
        }
        $dataProvider = new CActiveDataProvider('Alert', array('criteria' => $criteria,));
        $this->render('list', array(
            'dataProvider' => $dataProvider,
            'qry' => $qryClean,
        ));
    }

    public function actionLog() {
        $sid = Yii::app()->session['system_id'];
        $qry = Yii::app()->request->getParam('query');
        $rid = Yii::app()->request->getParam('rid');
        
        $qryClean = isset($qry) ? $qry : null;
        $qry = isset($qry) ? $qry : null;
        
        $ridClean = isset($rid) ? $rid : null;
        $rid = isset($rid) ? $rid : null;

        $criteria = new CDbCriteria();
        if (isset($qry)) {
            $criteria->addCondition("alname LIKE '%" . $qry . "%'");
        }
        if (isset($rid)) {
            $criteria->addCondition("alid=" . $rid);
        }
        $dataProvider = new CActiveDataProvider('AlertLog', array('criteria' => $criteria,));
        $this->render('list_log', array(
            'dataProvider' => $dataProvider,
            'qry' => $qryClean,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Alert');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Alert('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Alert']))
            $model->attributes = $_GET['Alert'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Alert the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Alert::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Alert $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'alert-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function getSensorNameAndId($sid) {
        $sData = Yii::app()->db->createCommand()
            ->from('sensor')
            ->join('sensor_type', 'sensor_type.id=sensor.type')
            ->where('sensor.id=' . $sid)
            ->andWhere('sensor.system_id=' . Yii::app()->session['system_id'])
            ->order('sensor.id')
            ->queryAll();

        return isset($sData[0]) ? $sData[0] : null;
    }

    public function getActuatorNameAndId($sid) {
        $sData = Yii::app()->db->createCommand()
            ->from('actuator')
            ->join('actuator_type', 'actuator_type.id=actuator.type')
            ->where('actuator.aid=' . $sid)
            ->andWhere('actuator.system_id=' . Yii::app()->session['system_id'])
            ->order('actuator.aid DESC')
            ->queryAll();

        return isset($sData[0]) ? $sData[0] : 0;
    }

}
