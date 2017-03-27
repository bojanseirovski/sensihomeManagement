<?php

class	SearchController	extends	Controller	{

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
																'actions'	=>	array('index',	'asearch',	'ssearch'),
																'users'	=>	array('*'),
												)
								);
				}

				public	function	actionIndex()	{
								$this->render('index');
				}

				//  AJAX
				public	function	actionAsearch($offset,	$limit)	{
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
								}
								catch	(Exception	$e)	{
												Yii::log("Can't get sensor data");
								}
								$this->output($sensorData);
				}


				public	function	actionSsearch($offset,	$limit)	{
								$dateFrom	=	Yii::app()->request->getPost('date_from');
								$dateFrom	=	isset($dateFrom)	?	$dateFrom	:	null;
								$dateTo	=	Yii::app()->request->getPost('date_to');
								$dateTo	=	isset($dateTo)	?	$dateTo	:	null;
								if	(!isset($dateFrom)	||	!isset($dateTo))	{
												throw	new	CHttpException(404,	'The requested page does not exist.');
								}
								$data	=	[];
								$sData	=	Yii::app()->db->createCommand()
																->from('sensor')
																->leftJoin('sensor_type',	'sensor_type.id=sensor.type')
																->leftJoin('measurement',	'measurement.sensor_id=sensor.id')
																->where('measurement.sensor=1')
																->andWhere('sensor.system_id='	.	Yii::app()->session['system_id'])
																->andWhere("measurement.date_measured>='"	.	$dateFrom."'")
																->andWhere("measurement.date_measured<='"	.	$dateTo."'")
																->order('measurement.id')
																->limit($limit,	$offset)
																->queryAll();
								foreach	($sData	as	$oneRead)	{
												if	(!in_array(array($oneRead['type_name'],	$oneRead['sensor_id'],	$oneRead['unit'],	$oneRead['name']),	$data))	{
																$data[]	=	array($oneRead['type_name'],	$oneRead['sensor_id'],	$oneRead['unit'],	$oneRead['name']);
												}
								}
				}
}
