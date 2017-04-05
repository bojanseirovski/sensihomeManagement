<?php

class	SearchController	extends	Controller	{

				public	$layout	=	'//layouts/column2';

				public	function	filters()	{
								return	[
												'accessControl',	// perform access control for CRUD operations
								];
				}

				public	function	accessRules()	{
								return	[
												[
																'allow',	// allow all users to perform 'index' and 'view' actions
																'actions'	=>	['index',	'asearch',	'ssearch'],
																'users'	=>	['*'],
												]
								];
				}

				public	function	actionIndex()	{
								$sid	=	Yii::app()->session['system_id'];
								$sensor	=	Yii::app()->request->getParam('s');
								$actuator	=	Yii::app()->request->getParam('a');
								$qry	=	Yii::app()->request->getParam('query');
								$datef	=	Yii::app()->request->getParam('datef');
								$datet	=	Yii::app()->request->getParam('datet');

								$qryClean	=	isset($qry)	?	$qry	:	null;
								$qry	=	isset($qry)	?	$qry	:	null;
								$isSensor	=	isset($sensor)	?	true	:	false;
								$isActuator	=	isset($actuator)	?	true	:	false;
								$nameIdsSensor	=	[];
								$nameIdsActuator	=	[];
								$devId	=	null;

								if	($isSensor)	{
												$devId	=	$sensor;
								}
								if	($isActuator)	{
												$devId	=	$actuator;
								}
								if($isActuator && $isSensor){
												throw new CHttpException(404, 'The requested page does not exist.');
								}

								$criteriaCondition	=	'';
								$criteriaConditionArr	=	[];
								if	(isset($devId))	{
												$criteriaConditionArr[]	=	'sensor_id='	.	$devId;
								}

								if	(!isset($devId) && isset($qry))	{
												$ids	=	$this->devIdByName($qry);
												$ids	=	count($ids)	?	$ids	:	[0];
												$qryIds	=	implode(',',	$ids);
												$criteriaConditionArr[]	=	'sensor_id IN ('	.	$qryIds	.	')';
								}
								if(isset($datef)){
												$criteriaConditionArr[]	=	"date_measured >'".$datef."'";
								}
								if(isset($datet)){
												$criteriaConditionArr[]	=	"date_measured <'".$datet."'";
												
								}
								$criteriaCondition	=	implode(' AND ',	$criteriaConditionArr);
								$criteria	=	new	CDbCriteria(['condition'	=>	$criteriaCondition]);
								$criteria->order	=	"id DESC";
								
								$mData	=	Measurement::model()->findAll($criteria);
								
								$dataProvider	=	new	CArrayDataProvider($mData,	array(
												'keyField'	=>	false,
												'pagination'	=>	array(
																'pageSize'	=>	30,
												),
								));
								;

								$this->render(
																'index',	
																[
																				'dataProvider'	=>	$dataProvider,	
																				'datef'	=>	$datef,	
																				'datet'	=>	$datet,	
																				'qry'	=>	$qry
																]
								);
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
												$cats	=	[];
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
																->andWhere("measurement.date_measured>='"	.	$dateFrom	.	"'")
																->andWhere("measurement.date_measured<='"	.	$dateTo	.	"'")
																->order('measurement.id')
																->limit($limit,	$offset)
																->queryAll();
								foreach	($sData	as	$oneRead)	{
												if	(!in_array(array($oneRead['type_name'],	$oneRead['sensor_id'],	$oneRead['unit'],	$oneRead['name']),	$data))	{
																$data[]	=	array($oneRead['type_name'],	$oneRead['sensor_id'],	$oneRead['unit'],	$oneRead['name']);
												}
								}
				}

				private	function	devIdByName($qry)	{
								$sid = Yii::app()->session['system_id'];
								$devIds	=	Yii::app()->db->createCommand()
																->select('id')
																->from('sensor')
																->where("sensor.name LIKE '%"	.	$qry	.	"%'")
																->andWhere('sensor.system_id='	.$sid)
																->order('sensor.id DESC')
																->queryAll();
								$devIds2	=	Yii::app()->db->createCommand()
																->select('aid')
																->from('actuator')
																->where("actuator.name LIKE '%"	.	$qry	.	"%' ")
																->andWhere('actuator.system_id='	.	$sid )
																->order('actuator.aid DESC')
																->queryAll();
								$devIds = array_merge($devIds, $devIds2);
								$allIds	=	[];
								foreach	($devIds	as	$oneDev)	{
												if	(isset($oneDev['id']) && !in_array($oneDev['id'],	$allIds))	{
																$allIds[]	=	$oneDev['id'];
												}
												if	(isset($oneDev['aid']) && !in_array($oneDev['aid'],	$allIds))	{
																$allIds[]	=	$oneDev['aid'];
												}
								}
								return	$allIds;
				}

}
