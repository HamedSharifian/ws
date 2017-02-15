<?php

namespace app\controllers;
use app\models\Users;
use app\components\ErrorManager;
use app\components\Result;
use Yii;

class UsersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionRegister(){
    	$model=new Users();
	$model->scenario=Users::SCENARIO_REGISTER;
    	if($model->load(Yii::$app->request->get())) {
           if($model->validate()){
               if($model->save()){
                 ErrorManager::encodeAndReturn(200,null,null);
                 return;
               }
               ErrorManager::encodeHttpError(500);
               return;
           }// validation error
           $errorInfos=ErrorManager::getErrorObjects($model->getErrors());
           echo \yii\helpers\Json::encode(new Result(-1,$errorInfos,null));
           return;

        } 
        ErrorManager::encodeHttpError(400);
        return;
    }
    
   

}
