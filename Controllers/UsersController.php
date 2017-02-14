<?php

namespace app\controllers;
use app\models\Users;
use app\components\ErrorManager;
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
                var_dump(Yii::$app->request->get());
            $errorCodes=array_push($errorCodes, ErrorManager::$errors[ErrorManager::invalid_arguments]);
            //echo("error");
        } else if( !$model->validate()){
            echo var_dump($model->getErrors());
        }

	echo \yii\helpers\Json::encode(ErrorManager::getErrorObjects($model->getErrors()));
    }

}
