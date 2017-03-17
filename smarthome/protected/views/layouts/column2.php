<?php	/* @var $this Controller */	?>
<?php	$this->beginContent('//layouts/main');	?>
<div class="span-5 first">
				<div id="sidebar">
								<?php
								$this->beginWidget('zii.widgets.CPortlet',	array(
												'title'	=>	'',
								));
								$this->widget('zii.widgets.CMenu',	array(
												'encodeLabel'	=>	false,
												'items'	=>	$this->menu,
												'htmlOptions'	=>	array('class'	=>	'operations'),
								));
								$this->endWidget();
								?>
				</div><!-- sidebar -->
</div>
<div class="span-19">
				<div id="content">
								<?php	echo	$content;	?>
				</div><!-- content -->
</div>
<div class="span-5 last">
				<div id="sidebar">
								<br/>
				</div><!-- sidebar -->
</div>
<?php	$this->endContent();	?>