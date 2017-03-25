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
        $models=Category::find()->all();
        $assetsFolder=Yii::$app->urlManager->createAbsoluteUrl('')."assets/icons/";
        foreach($models as $model){
            $model->icon=$assetsFolder.$model->icon;
        }
        ErrorManager::encodeAndReturn(200, null, $models);
        /*
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
           ErrorManager::encodeAndReturn(-1,$errorInfos,null);
           return;
        } 
        ErrorManager::encodeHttpError(400);
        return;*/
    } 
    
    public function actionTest(){
        echo Yii::$app->urlManager->createAbsoluteUrl('');
    }
    
    
    
 
   

}
