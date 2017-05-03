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
        $store=new \app\models\Stores();
	 $category->scenario= \app\models\Category::SCENARIO_GET_STOKCS;
         $store->scenario=\app\models\Stores::SCENARIO_GET_STOKCS;
    	 if($category->load(Yii::$app->request->get()) && $store->load(Yii::$app->request->get())) {
           if($category->validate() && $store->validate()){
               //$subcats=  \app\models\Subcategory::find()->where(["CATEGORY"=>$category->ID])->select(["ID"]);//->all();
              // $prodcuts= \app\models\Products::find()->where('in',"subCategory",$subcats);
              // echo \yii\helpers\Json::encode($prodcuts->all());
               $query=new \yii\db\Query();
               $result=  $query->select("s.*")->from("stocks s,products,subcategories")->where("price is not null && productTo=products.ID && products.subCategory=subcategories.ID && subcategories.CATEGORY=$category->ID && storeTo=$store->ID");
               //var_dump($query->createCommand()->queryAll());
               ErrorManager::encodeAndReturn(200, null, $query->createCommand()->queryAll());
               return;
           }// validation error
           if(!$category->validate()){
             $errorInfos=ErrorManager::getErrorObjects($category->getErrors());
              ErrorManager::encodeAndReturn(-1,$errorInfos,null);
           }else{
               $errorInfos=ErrorManager::getErrorObjects($store->getErrors());
              ErrorManager::encodeAndReturn(-1,$errorInfos,null);
           }
           return;
        } 
        ErrorManager::encodeHttpError(400);
        return;
        
        
    }
    
    
    
 
   

}
