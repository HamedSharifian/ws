<?php

namespace app\controllers;
use app\models\Users;
use app\components\ErrorManager;
use app\components\Result;
use Yii;

class FavouritesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    
     public function actionAdd()
     {
        $user=new Users();
        $favourite=new \app\models\Favorites();
        // scenarios
	$user->scenario=  Users::SCENARIO_ACCESS_ACCOUNT;
        $favourite->scenario=  \app\models\Favorites::SCENARIO_ADD;
    	if($user->load(Yii::$app->request->get()) && $favourite->load(Yii::$app->request->get())) {
           if($user->validate() && $favourite->validate()){
               $user_dbmodel=$user->findByEmail($user->email);
               $favourite->userTo=$user_dbmodel->ID;
               if(!$favourite->validate()){ // duplicate favourites
                  $errorInfos=ErrorManager::getErrorObjects($favourite->getErrors());
                  echo \yii\helpers\Json::encode(new Result(-1,$errorInfos,null));
                  return;
               }
               if($favourite->save()){
                 ErrorManager::encodeAndReturn(200,null,null);
                 return;
               } 
               ErrorManager::encodeHttpError(500);
               return;
           }// validation error
           $errors=null;
           if(!$user->validate()){
             $errors=$user->getErrors();
           } else{
               $errors=$favourite->getErrors();
           }
           $errorInfos=ErrorManager::getErrorObjects($errors);
           echo \yii\helpers\Json::encode(new Result(-1,$errorInfos,null));
           return;
        } 
        ErrorManager::encodeHttpError(400);
        return;
    }
    
    public function actionGetall(){
         $user=new Users();
	 $user->scenario= Users::SCENARIO_ACCESS_ACCOUNT ;
         $userId=-1;
         if($user->load(Yii::$app->request->get())) {
           if($user->validate()){
    	       $dbUser=  Users::findByEmail($user->email);
               $userId=$dbUser->ID;
           }else{// validation error
                $errorInfos=ErrorManager::getErrorObjects($user->getErrors());
                 ErrorManager::encodeAndReturn(-1,$errorInfos,null);
                 return;
           }
        }
        
         $store=new app\models\Stores();
	 $store->scenario= \app\models\Stores::SCENARIO_ACCESS_ACCOUNT ;
         $userId=-1;
         if($user->load(Yii::$app->request->get())) {
           if($user->validate()){
    	       $dbUser=  Users::findByEmail($user->email);
               $userId=$dbUser->ID;
           }else{// validation error
                $errorInfos=ErrorManager::getErrorObjects($user->getErrors());
                 ErrorManager::encodeAndReturn(-1,$errorInfos,null);
                 return;
           }
        }        
         
         
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

}
