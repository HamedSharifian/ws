<?php

namespace app\controllers;
use app\models\Users;
use Yii;

class UsersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionRegister(){
    	$model=new Users();
    	if($model->load(Yii::$app->request->post()) && $model->validate()) {
            echo "validated";
        } else {
            echo "error";
        }

    }

}
