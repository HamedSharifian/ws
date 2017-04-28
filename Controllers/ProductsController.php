<?php

namespace app\controllers;
use app\components\ErrorManager;
use Yii;

class ProductsController extends \yii\web\Controller
{
    

      public function actionGet(){
         $model=new \app\models\Products();
	 $model->scenario= \app\models\Products::SCENARIO_GET_PRODUCT;
    	 if($model->load(Yii::$app->request->get())) {
           if($model->validate()){
    	       $dbModel= \app\models\Products::find()
                       ->where(["ID"=>$model->ID])->one();
               ErrorManager::encodeAndReturn(200, null, $dbModel);
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
