<?php

class MainController extends Controller {

    public $defaultAction = 'index';

    public function init() {
        //Основной шаблон
        $this->layout = 'main';
    }

	public function actionIndex() {
		$this->render('index');
	}
    
    public function action404() {
        $this->render('404');
    }

	public function actionError() {
		if($error=Yii::app()->errorHandler->error) {
			if(Yii::app()->request->isAjaxRequest) {
				echo $error['message'];
			} else {
				$this->render('error', $error);
			}
		}
	}
}