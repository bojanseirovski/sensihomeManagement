<?php
/* @var $this SensorController */
/* @var $data Sensor */
?>


<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
        <?php 
            $typeName = '';
            try{
                $sensorType = SensorType::model()->findByPk($data->id);
                $typeName = is_object($sensorType)?$sensorType->getAttribute('type_name'):'Sensor ID :'.$data->id;
            }
            catch(Exception $e){
                Yii::log($e->getMessage());
            }            
        ?>
	<?php echo CHtml::link(CHtml::encode($typeName), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit')); ?>:</b>
	<?php echo CHtml::encode($data->unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('value_fields')); ?>:</b>
	<?php echo CHtml::encode($data->value_fields); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('com_id')); ?>:</b>
	<?php echo CHtml::encode($data->com_id); ?>
	<br />

	<b>System :</b>
        <?php 
            $system ='';
            try{
                $sys= System::model()->findByPk( $data->system_id);
                $system = is_object($sys)?$sys->getAttribute('name'):'';
            }
            catch(Exception $e){
                Yii::log($e->getMessage());
            }
        ?>
	<?php echo CHtml::encode($system); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />


</div>
<hr/>