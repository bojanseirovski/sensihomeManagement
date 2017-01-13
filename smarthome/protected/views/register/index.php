<?php
/* @var $this RegisterController */

$this->breadcrumbs=array(
	'Register',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	<?=$this->renderPartial('register',array('model'=>$model));?>
</p>
