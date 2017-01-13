<?php
/* @var $this ActuatorController */
/* @var $data Actuator */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
        <?php 
            $typeName = '';
            try{
                $actType = ActuatorType::model()->findByPk($data->aid);
                $typeName = is_object($actType)?$actType->getAttribute('type_name'):'Actuator ID: '.$data->aid;
            }
            catch(Exception $e){
                Yii::log($e->getMessage());
            }            
        ?>
	<?php echo CHtml::link(CHtml::encode($typeName), array('viewone', 'id'=>$data->aid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('com_id')); ?>:</b>
	<?php echo CHtml::encode($data->com_id); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('value_fields')); ?>:</b>
	<?php echo CHtml::encode($data->value_fields); ?>
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