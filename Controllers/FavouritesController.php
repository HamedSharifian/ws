<?php

namespace app\controllers;
use app\models\Users;
use app\models\Stocks;
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
         $stock=new Stocks();
         $user->scenario= Users::SCENARIO_ACCESS_ACCOUNT ;
	 $stock->scenario= \app\models\Stocks::SCENARIO_GET_FAVOURITES ;
         if($user->load(Yii::$app->request->get()) && $stock->load(Yii::$app->request->get())) {
           if($user->validate() && $stock->validate()){
    	       $dbUser=  Users::findByEmail($user->email);
               $userId=$dbUser->ID;
               
               $query = new \yii\db\Query();
                $query->select('s.*')
                    ->from("stocks s ,favorites f,products p ")
                      ->where("f.userTo = $dbUser->ID AND f.`productTo` = p.`ID` AND s.`productTo` = p.`ID`  AND s.`storeTo`= $stock->storeTo")
                     ->andWhere(["is not","price",null]);

                      $stocks = $query->all();
               ErrorManager::encodeAndReturn(200, null, $stocks);

               return;
               
               
          
               
           }else{// validation error
               $errors=null;
               if(!$user->validate()){
               $errors=$user->getErrors();
                } else{
                  $errors=$store->getErrors();
               }
                 $errorInfos=ErrorManager::getErrorObjects($errors);
                  echo \yii\helpers\Json::encode(new Result(-1,$errorInfos,null));
                  return;
              }
        }
       ErrorManager::encodeHttpError(400);
       return;
       
    }

}
