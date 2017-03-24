<?php

namespace app\controllers;
use app\models\Subcategory1;
use yii\helpers\Html;
use app\components\ErrorManager;
use app\components\Result;
use Yii;

class Subcategory1Controller extends \yii\web\Controller
{
   
    
   
    
   
    
     public function actionGetall(){
    $model=new Subcategory1();
	$model->scenario=  Subcategory1::SCENARIO_GETALL;
    	if($model->load(Yii::$app->request->get())) {
           if($model->validate()){
              // if($model->save()){
                // ErrorManager::encodeAndReturn(200,null,null);
                // return;
              // }
               $models=$model->find()->where(["category"=>$model->category])->all();
               ErrorManager::encodeAndReturn(200, null, $models);

              // var_dump($model);
               //ErrorManager::encodeHttpError(500);
               return;
           }// validation error
           $errorInfos=ErrorManager::getErrorObjects($model->getErrors());
           ErrorManager::encodeAndReturn(-1,$errorInfos,null);
           return;
        } 
        ErrorManager::encodeHttpError(400);
        return;
    }
    
    
    
 
   

}
