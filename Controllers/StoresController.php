<?php

namespace app\controllers;
use app\models\Users;
use yii\helpers\Html;
use app\components\ErrorManager;
use app\components\Result;
use Yii;

class StoresController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionGetall(){
    	$stores= \app\models\Stores::findAll("1==1");
        ErrorManager::encodeAndReturn(200, null, $stores);
    } 
    
    
    public function actionLogin(){
        $model=new Users();
	$model->scenario=Users::SCENARIO_LOGIN;
    	if($model->load(Yii::$app->request->get())) {
           if($model->validate()){
               ErrorManager::encodeAndReturn(200, null, null);
               return;
           }// validation error
           $errorInfos=ErrorManager::getErrorObjects($model->getErrors());
           echo \yii\helpers\Json::encode(new Result(-1,$errorInfos,null));
           return;

        } 
        ErrorManager::encodeHttpError(400);
        return;
    }
    
    public function actionEdit(){
        $model=new Users();
	$model->scenario=Users::SCENARIO_EDIT;
    	if($model->load(Yii::$app->request->get())) {
           if($model->validate()){
               $db_model=$model->findByEmail($model->email);
               $db_model->postCode=$model->postCode;
               $db_model->name=$model->name;
               if($db_model->save()){
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
    
    public function actionTest(){
        echo hash_hmac("SHA256", "abcdef", "123456",false);
    }
    
 
 
   

}
