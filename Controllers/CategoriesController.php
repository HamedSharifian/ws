<?php

namespace app\controllers;
use app\models\Category;
use yii\helpers\Html;
use app\components\ErrorManager;
use app\components\Result;
use Yii;

class CategoriesController extends \yii\web\Controller
{
   
    
   
    
   
    
     public function actionGetall(){
    $model=new Category();
	$model->scenario= Category::SCENARIO_GETALL;
    	if($model->load(Yii::$app->request->get())) {
           if($model->validate()){
              // if($model->save()){
                // ErrorManager::encodeAndReturn(200,null,null);
                // return;
              // }
               $models=$model->find()->where(["MAIN_CATEGORY"=>$model->MAIN_CATEGORY])->all();
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
