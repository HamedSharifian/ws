<?php

namespace app\controllers;
use app\components\ErrorManager;
use Yii;

class StocksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionGetall(){
    	$model=new \app\models\Stocks();
	 $model->scenario= \app\models\Stocks::SCENARIO_GET_BEAST_DEALS;
    	 if($model->load(Yii::$app->request->get())) {
           if($model->validate()){
              
    	       $models= \app\models\Stocks::find()
                       ->where(["storeTo"=>$model->storeTo])
                       ->andWhere(["is not","discount",null])
                       ->orderBy(['discount' => SORT_DESC])->all();
               
               ErrorManager::encodeAndReturn(200, null, $models);

               return;
           }// validation error
           $errorInfos=ErrorManager::getErrorObjects($model->getErrors());
           ErrorManager::encodeAndReturn(-1,$errorInfos,null);
           return;
        } 
        ErrorManager::encodeHttpError(400);
        return;
    } 
    
    public function actionGetbest(){
         $model=new \app\models\Stocks();
	 $model->scenario= \app\models\Stocks::SCENARIO_GET_BEAST_DEALS;
    	 if($model->load(Yii::$app->request->get())) {
           if($model->validate()){
              // if($model->save()){
                // ErrorManager::encodeAndReturn(200,null,null);
                // return;
              // }
              
    	       $models= \app\models\Stocks::find()
                       ->where(["storeTo"=>$model->storeTo])
                       ->andWhere(["is not","discount",null])
                       ->orderBy(['discount' => SORT_DESC])->limit(10)->all();
               
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
