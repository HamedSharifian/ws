<?php

namespace app\controllers;
use app\models\Users;
use yii\helpers\Html;
use app\components\ErrorManager;
use app\components\Result;
use Yii;

class StoresController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionGetall(){
    	$models=  \app\models\Stores::find()->all();
        //$assetsFolder=Yii::$app->urlManager->createAbsoluteUrl('')."assets/icons/";
        //foreach($models as $model){
           // $model->logo=$assetsFolder.$model->logo;
        //}
        ErrorManager::encodeAndReturn(200, null, $models);
    } 
    

 
 
   

}

