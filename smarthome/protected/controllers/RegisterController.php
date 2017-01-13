<?php

class RegisterController extends Controller {

    public function actionIndex() {
        $model = new RegisterForm();
        if (isset($_POST['RegisterForm'])) {
            $model->attributes = $_POST['RegisterForm'];
            if ($model->validate() && $model->register()) {
                $this->redirect($this->createAbsoluteUrl('/sensor/index'));
            }
        }
        $this->render('index', array('model' => $model));
    }

}