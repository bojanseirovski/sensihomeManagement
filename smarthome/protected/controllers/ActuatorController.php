<?php

class	ActuatorController	extends	Controller	{

				/**
					* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
					* using two-column layout. See 'protected/views/layouts/column2.php'.
					*/
				public	$layout	=	'//layouts/column2';

				/**
					* @return array action filters
					*/
				public	function	filters()	{
								return	array(
												'accessControl',	// perform access control for CRUD operations
								);
				}

				/**
					* Specifies the access control rules.
					* This method is used by the 'accessControl' filter.
					* @return array access control rules
					*/
				public	function	accessRules()	{
								return	array(
												array('allow',	// allow all users to perform 'index' and 'view' actions
																'actions'	=>	array('index',	'view'),
																'users'	=>	array('*'),
												),
												array('allow',	// allow authenticated user to perform 'create' and 'update' actions
																'actions'	=>	array('create',	'update'),
																'users'	=>	array('@'),
												),
												array('allow',	// allow admin user to perform 'admin' and 'delete' actions
																'actions'	=>	array('admin',	'delete'),
																'users'	=>	array('@'),
												),
								);
				}

				public	function	actionIndex()	{
								$this->render('index');
				}

				/**
					* Displays a particular model.
					* @param integer $id the ID of the model to be displayed
					*/
				public	function	actionView($id)	{
								$this->render('view',	array(
												'model'	=>	$this->loadModel($id),
								));
				}

				public	function	actionViewone($id)	{
								$this->render('view',	array(
												'model'	=>	$this->loadModel($id),
								));
				}

				/**
					* Creates a new model.
					* If creation is successful, the browser will be redirected to the 'view' page.
					*/
				public	function	actionCreate()	{
								$model	=	new	Actuator;

								// Uncomment the following line if AJAX validation is needed
								// $this->performAjaxValidation($model);
								$typeList	=	ActuatorType::model()->findAll();
								$typeArray	=	array();
								foreach	($typeList	as	$oneType)	{
												$typeArray[$oneType->getAttribute('id')]	=	$oneType->getAttribute('name');
								}
								if	(isset($_POST['Actuator']))	{
												$model->attributes	=	$_POST['Actuator'];
												if	($model->save())
																$this->redirect(array('view',	'id'	=>	$model->id));
								}

								$this->render('create',	array(
												'model'	=>	$model,
								));
				}

				/**
					* Updates a particular model.
					* If update is successful, the browser will be redirected to the 'view' page.
					* @param integer $id the ID of the model to be updated
					*/
				public	function	actionUpdate($id)	{
								$model	=	$this->loadModel($id);

								// Uncomment the following line if AJAX validation is needed
								// $this->performAjaxValidation($model);

								if	(isset($_POST['Actuator']))	{
												$model->attributes	=	$_POST['Actuator'];
												if	($model->save())
																$this->redirect(array('view',	'id'	=>	$model->aid));
								}

								$this->render('update',	array(
												'model'	=>	$model,
								));
				}

				/**
					* Deletes a particular model.
					* If deletion is successful, the browser will be redirected to the 'admin' page.
					* @param integer $id the ID of the model to be deleted
					*/
				public	function	actionDelete($id)	{
								$this->loadModel($id)->delete();
								$this->redirect($this->createAbsoluteUrl('actuator/list'));
				}

				/**
					* Lists all models.
					*/
				public	function	actionList()	{
								$sid	=	Yii::app()->session['system_id'];
								$qry	=	Yii::app()->request->getParam('query');
								$qryClean	=	isset($qry)	?	$qry	:	null;
								$qry	=	isset($qry)	?	$qry	:	null;

								$criteriaCondition	=	'system_id='	.	$sid;
								$criteria	=	new	CDbCriteria(['condition'	=>	$criteriaCondition]);
								if	(isset($qry))	{
												$criteria->addCondition("name LIKE '%"	.	$qry	.	"%'",	'AND');
												$criteria->addCondition("com_id LIKE '%"	.	$qry	.	"%'",	'OR');
												$criteria->addCondition("serial LIKE '%"	.	$qry	.	"%'",	'OR');
								}

								$dataProvider	=	new	CActiveDataProvider('Actuator',	['criteria'	=>	$criteria]);

								$this->render(
																'list',	array(
																'dataProvider'	=>	$dataProvider,
																'qry'	=>	$qryClean,
												)
								);
				}

				/**
					* Manages all models.
					*/
				public	function	actionAdmin()	{
								$model	=	new	Actuator('search');
								$model->unsetAttributes();		// clear any default values
								if	(isset($_GET['Actuator']))
												$model->attributes	=	$_GET['Actuator'];

								$this->render('admin',	array(
												'model'	=>	$model,
								));
				}

				/**
					* Returns the data model based on the primary key given in the GET variable.
					* If the data model is not found, an HTTP exception will be raised.
					* @param integer $id the ID of the model to be loaded
					* @return Actuator the loaded model
					* @throws CHttpException
					*/
				public	function	loadModel($id)	{
								$model	=	Actuator::model()->findByPk($id);
								if	($model	===	null)	{
												throw	new	CHttpException(404,	'The requested page does not exist.');
								}
								return	$model;
				}

				/**
					* Performs the AJAX validation.
					* @param Actuator $model the model to be validated
					*/
				protected	function	performAjaxValidation($model)	{
								if	(isset($_POST['ajax'])	&&	$_POST['ajax']	===	'actuator-form')	{
												echo	CActiveForm::validate($model);
												Yii::app()->end();
								}
				}

				public	function	actionOne($id)	{
								$critieria	=	new	CDbCriteria(['order'	=>	'id DESC']);
								$lastMeasurement	=	Measurement::model()->findByAttributes(
																['sensor'	=>	0,	'sensor_id'	=>	$id],	$critieria
								);
								$lastVal	=	isset($lastMeasurement->value)	?	$lastMeasurement->value	:	0;
								$this->render('show_one',	array('id'	=>	$id,	'data'	=>	$this->loadModel($id),	'lastVal'	=>	$lastVal));
				}

				public	function	actionToggle()	{

								$req	=	Yii::app()->request;

								$id	=	$req->getParam('id')	?	$req->getParam('id')	:	null;
								$url	=	$req->getParam('url')	?	$req->getParam('url')	:	null;
								$out	=	['status'	=>	'ERROR'];
								if	(isset($id)	&&	isset($url))	{
												$stateChanged	=	Util::getSimpleRequest($url);
												$measure	=	new	Measurement();
												$measure->sensor_id	=	$id;
												$measure->value	=	($stateChanged['pin2']	==	'OFF')	?	"0"	:	"1";
												$measure->sensor	=	0;
												$measure->save(false);
												$out	=	['status'	=>	'OK'];
								}
								$this->output($out);
				}

				//  AJAX
				public	function	actionActuators()	{
								$req	=	Yii::app()->request;
								$limit	=	$req->getParam('page')	?	$req->getParam('page')	:	15;
								$offset	=	$req->getParam('offset')	?	$req->getParam('offset')	:	0;

								$sensorData	=	null;
								try	{
												$cats	=	array();
												$sData	=	Actuator::model()->getData($offset,	$limit);

												if	(count($sData)	<	1)	{
																$sData	=	Actuator::model()->getAll($offset,	$limit);
												}
												foreach	($sData	as	$k	=>	$oneRead)	{
																$oneSenData	=	isset($oneRead['aid'])	?	$oneRead['aid']	:	"0";
																if	(!in_array(array($oneRead['type_name'],	$oneSenData,	$oneRead['name']),	$cats))	{
																				$cats[]	=	array($oneRead['type_name'],	$oneSenData,	$oneRead['name']);
																}

																$sData[$k]['value']	=	isset($sData[$k]['value'])	?	$sData[$k]['value']	:	0;
																$sData[$k]['date_measured']	=	isset($sData[$k]['date_measured'])	?	$sData[$k]['date_measured']	:	date('Y-m-d h:i:s');
																$sData[$k]['message']	=	isset($sData[$k]['message'])	?	$sData[$k]['message']	:	'';
												}
												$sensorData['data']	=	$sData;
												$sensorData['cats']	=	$cats;
												$sensorData['sensor_type_count']	=	count($cats);
								}	catch	(Exception	$e)	{
												Yii::log("Can't get sensor data:"	.	$e->getMessage());
								}

								$this->output($sensorData);
				}

				//  AJAX
				public	function	actionActuator($id)	{
								$sensorData	=	null;
								try	{
												$cats	=	array();
												$sData	=	Actuator::model()->getData(0,	15,	$id);
												if	(count($sData)	<	1)	{
																$sData	=	Actuator::model()->getAll(0,	15,	$id);
												}
												foreach	($sData	as	$k	=>	$oneRead)	{
																if	(!in_array(array($oneRead['type_name'],	$oneRead['aid']),	$cats))	{
																				$cats[]	=	array($oneRead['type_name'],	$oneRead['aid']);
																}
																$sData[$k]['value']	=	isset($sData[$k]['value'])	?	$sData[$k]['value']	:	0;
																$sData[$k]['date_measured']	=	isset($sData[$k]['date_measured'])	?	$sData[$k]['date_measured']	:	date('Y-m-d h:i:s');
																$sData[$k]['message']	=	isset($sData[$k]['message'])	?	$sData[$k]['message']	:	'';
												}
												$sensorData['data']	=	$sData;
												$sensorData['cats']	=	$cats;
								}	catch	(Exception	$e)	{
												Yii::log("Can't get sensor data");
								}
								$this->output($sensorData);
				}

				//  AJAX
				public	function	actionDatesearch($offset,	$limit)	{
								$dateFrom	=	Yii::app()->request->getPost('date_from');
								$dateFrom	=	isset($dateFrom)	?	$dateFrom	:	null;
								$dateTo	=	Yii::app()->request->getPost('date_to');
								$dateTo	=	isset($dateTo)	?	$dateTo	:	null;
								$offset	=	!isset($offset)	?	0	:	$offset;
								$limit	=	!isset($limit)	?	25	:	$limit;

								if	(!isset($dateFrom)	||	!isset($dateTo))	{
												throw	new	CHttpException(404,	'The requested page does not exist.');
								}
								$sensorData	=	null;
								try	{
												$cats	=	array();
												$sData	=	Actuator::model()->getDataByDate($dateFrom,	$dateTo,	$offset,	$page);
												if	(count($sData)	<	1)	{
																$sData	=	Actuator::model()->getAll(0,	15,	$id);
												}
												foreach	($sData	as	$k	=>	$oneRead)	{
																if	(!in_array(array($oneRead['type_name'],	$oneRead['aid']),	$cats))	{
																				$cats[]	=	array($oneRead['type_name'],	$oneRead['aid']);
																}
																$sData[$k]['value']	=	isset($sData[$k]['value'])	?	$sData[$k]['value']	:	0;
																$sData[$k]['date_measured']	=	isset($sData[$k]['date_measured'])	?	$sData[$k]['date_measured']	:	date('Y-m-d h:i:s');
																$sData[$k]['message']	=	isset($sData[$k]['message'])	?	$sData[$k]['message']	:	'';
												}
												$sensorData['data']	=	$sData;
												$sensorData['cats']	=	$cats;
								}	catch	(Exception	$e)	{
												Yii::log("Can't get sensor data");
								}
								$this->output($sensorData);
				}

}
