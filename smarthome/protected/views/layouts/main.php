<?php
$baseUrl = Yii::app()->request->baseUrl;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="en">
								<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <link  rel="stylesheet" type="text/css" href="<?= $baseUrl; ?>/js/jqplot/jquery.jqplot.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= $baseUrl; ?>/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?= $baseUrl; ?>/css/sb-admin.css">
        <link rel="stylesheet" type="text/css" href="<?= $baseUrl; ?>/css/font-awesome/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?= $baseUrl; ?>/css/form.css">
        <link rel="stylesheet" type="text/css" href="<?= $baseUrl; ?>/css/smarthome/general.css">

        <script type="text/javascript" src="<?= $baseUrl; ?>/js/jqplot/jquery.min.js"></script>
        <script type="text/javascript" src="<?= $baseUrl; ?>/js/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= $baseUrl; ?>/js/jqplot/jquery.jqplot.min.js"></script>
        <script type="text/javascript" src="<?= $baseUrl; ?>/js/smarthome/functions.js"></script>
        <script type="text/javascript" src="<?= $baseUrl; ?>/js/smarthome/functions.ajax.js"></script>
        <script type="text/javascript" src="<?= $baseUrl; ?>/js/smarthome/general.js"></script>
	
	<script type="text/javascript" src="<?= $baseUrl; ?>/js/jqplot/plugins/jqplot.barRenderer.js"></script>
	<script type="text/javascript" src="<?= $baseUrl; ?>/js/jqplot/plugins/jqplot.categoryAxisRenderer.js"></script>
	<script type="text/javascript" src="<?= $baseUrl; ?>/js/jqplot/plugins/jqplot.pointLabels.js"></script>
	<script type="text/javascript" src="<?= $baseUrl; ?>/js/jqplot/plugins/jqplot.highlighter.js"></script>
	<script type="text/javascript" src="<?= $baseUrl; ?>/js/jqplot/plugins/jqplot.cursor.js"></script>
	<script type="text/javascript" src="<?= $baseUrl; ?>/js/jqplot/plugins/jqplot.dateAxisRenderer.js"></script>

        <script type="text/html" id="base_url"><?= Yii::app()->urlManager->baseUrl; ?></script>
        <script type="text/html" id="base_url_path"><?= $baseUrl; ?></script>

        <title><?= CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
        <div id="wrapper">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= $baseUrl; ?>"><?= Yii::app()->name; ?></a>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
		    <?php
		    $this->widget('zii.widgets.CMenu', array(
			'activeCssClass' => 'active',
			'activateParents' => false,
			'htmlOptions' => array(
			    'class' => 'nav navbar-nav side-nav',
			),
			'encodeLabel' => false,
			'items' => array(
			    array(
				'label' => '<i class="fa fa-bar-chart" aria-hidden="true"></i> Home',
				'url' => array('/site/index'),
				'itemOptions' => array('class' => 'submenu-parent'),
			    ),
			    array(
				'label' => '<i class="fa fa-fw fa-dashboard"></i> Sensors',
				'url' => array('/sensor/index'),
				'itemOptions' => array('class' => 'submenu-parent'),
				'visible' => !Yii::app()->user->isGuest
			    ),
			    array(
				'label' => '<i class="fa fa-power-off" aria-hidden="true"></i> Actuators',
				'url' => array('/actuator/index'),
				'itemOptions' => array('class' => 'submenu-parent'),
				'visible' => !Yii::app()->user->isGuest
			    ),
			    array(
				'label' => '<i class="fa fa-square-o" aria-hidden="true"></i> Rules',
				'url' => array('/alert/list'),
				'itemOptions' => array('class' => 'submenu-parent'),
				'visible' => !Yii::app()->user->isGuest
			    ),
			    array(
				'label' => '<i class="fa fa-wrench" aria-hidden="true"></i> Settings',
				'url' => array('/user/' . Yii::app()->session['user_id']),
				'visible' => !Yii::app()->user->isGuest
			    ),
			    array('label' => '<i class="fa fa-sign-in" aria-hidden="true"></i> Login', 'url' => array('/login/login'), 'visible' => Yii::app()->user->isGuest),
			    array('label' => '<i class="fa fa-users"></i> Register', 'url' => array('/register'), 'visible' => Yii::app()->user->isGuest),
			    array('label' => '<i class="fa fa-sign-out" aria-hidden="true"></i> Logout (' . Yii::app()->session['user_name'] . ')', 'url' => array('/login/logout'), 'visible' => !Yii::app()->user->isGuest)
			),
		    ));
		    ?>
                </div>
            </nav>
            <!--</div> mainmenu -->


            <div id="page-wrapper">
                <div class="container-fluid">

		    <?= $content; ?>

                    <div id="footer">
                        <div> &copy; SensiStash </div>
                    </div><!-- footer -->
                </div>
            </div>
        </div>

    </body>
</html>
