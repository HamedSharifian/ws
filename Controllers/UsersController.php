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
                echo "not loaded! </br>";
            	echo \yii\helpers\Json::encode(ErrorManager::getErrorObjects($model->getErrors()));

               // var_dump(Yii::$app->request->get());
           // $errorCodes=array_push($errorCodes, ErrorManager::getErrorObjects(ErrorManager::invalid_arguments]);
            //echo("error");
        } else{
            ErrorManager::finishWithError(400);
        }

	echo \yii\helpers\Json::encode(ErrorManager::getErrorObjects($model->getErrors()));
    }

}
