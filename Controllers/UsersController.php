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
	$model->scenario=Users::SCENARIO_REGISTER;
    	if($model->load(Yii::$app->request->get())) {
           if($model->validate()){
               if($model->save()){
                 echo "saved!";
               }else{
                   ErrorManager::finishWithError(500);
               }
           }else{
               echo \yii\helpers\Json::encode(ErrorManager::getErrorObjects($model->getErrors()));
           }

        } else{
            ErrorManager::finishWithError(400);
        }
    }
    
   

}
