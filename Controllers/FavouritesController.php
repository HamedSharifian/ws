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
	$user->scenario=  Users::SCENARIO_ADD_FAVOURITE;
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

}
