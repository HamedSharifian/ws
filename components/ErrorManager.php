<?php
namespace app\components;

use yii\base\Component;
use Yii;

class ErrorManager extends Component{
    
    
//http erros
const bad_Request="400";
const server_internal_error="500";
    
    
 const  invalid_arguments='900';
//***************  USERS  *******************
const empty_name='891';
const empty_email='901';
const invalid_email='902';
const invalid_name='903';
const invalid_password='1001';
const duplicate_email='904';
const invalid_postCode='1011';
//**********************************************
 static $errorsDescFA=
[
        self::bad_Request=>"درخواست اشتباه است.",
        self::server_internal_error=>"خطای داخلی سرور",
        
        self::empty_name =>"نام وارد نشده است.",
	self::invalid_arguments=>"900",
        self::empty_email=>"ایمیل وارد نشده است.",
	self::invalid_email=>"ایمیل نامعتبر است",
	self::invalid_name =>"نام نامعتبر است",
	self::invalid_password=>"رمز عبور نامعتبر است",
	self::duplicate_email=>"این ایمیل قبلا ثبت شده است.",
        self::invalid_postCode=>"کد  بستی نامعتبر است."
];

public static function getErrorObjects($attributesErrors){
        $ErrorInfoList=Array();
        foreach($attributesErrors as $attributeError){
            foreach($attributeError as $error){
                 $errorInfo=new ErrorInfo();
                 $errorInfo->code=$error;
                 $errorInfo->decscriptionFa=  self::$errorsDescFA[$error];
                 array_push($ErrorInfoList, $errorInfo);
            }
        }
        return $ErrorInfoList;
}

public static function encodeHttpError($httpCode){
    Yii::$app->response->statusCode = $httpCode;
    $errorInfo=new ErrorInfo();
    $errorInfo->code=$httpCode;
    $errorInfo->decscriptionFa= self::$errorsDescFA[$httpCode];
    echo \yii\helpers\Json::encode(new Result(-1,$errorInfo,null));
}

public static function encodeAndReturn($statusCode,$erros,$data){
    $result=new Result($statusCode,$erros,$data);
    echo \yii\helpers\Json::encode($result);
}







}