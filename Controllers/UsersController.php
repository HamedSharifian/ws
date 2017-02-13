<?php

namespace app\controllers;
use app\models\Users;
use app\mycomponents\errorManager;
use Yii;

class UsersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionRegister(){
    	$model=new Users();
		$errorCodes=Array();
		$model->scenario=Users::SCENARIO_REGISTER;
    	if($model->load(Yii::$app->request->get())) {
            $error_codes=array_push($errorCodes,errors[invalid_arguments]);
        } else if( $model->validate()){
            echo var_dump($model->getErrors());
        }
		var_dump($errorCodes);
    }

}
