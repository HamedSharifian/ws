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
    
     public function actionGetstocks(){
        $category=new \app\models\Category();
	 $category->scenario= \app\models\Category::SCENARIO_GET_STOKCS;
    	 if($category->load(Yii::$app->request->get())) {
           if($category->validate()){
               echo $category->ID;
               //$subCategoriesQuery=  \app\models\Subcategory::find()->where(['CATEGORY'=>$category->ID])->select('ID');
               //$productQuery= \app\models\Products::find()->where(['in','33',$subCategoriesQuery]);
               
              // echo json_encode($subCategoriesQuery->all());
               $query=  \app\models\Subcategory::find()->where(['CATEGORY'=>$category->ID])->joinWith("products")->joinWith("stocks");
               var_dump($query->all());
               
               
              // $stocks= \app\models\Stocks::find()->where(["productTo"=>$model->productTo])->all();
              // ErrorManager::encodeAndReturn(200, null, $dbModel);
               return;
           }// validation error
           $errorInfos=ErrorManager::getErrorObjects($category->getErrors());
           ErrorManager::encodeAndReturn(-1,$errorInfos,null);
           return;
        } 
        ErrorManager::encodeHttpError(400);
        return;
        
        
    }
    
    
    
 
   

}
