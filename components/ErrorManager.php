<?php
namespace app\components;

use yii\base\Component;
use Yii;

class ErrorManager extends Component{
    
    
//http erros
const bad_Request="400";
const server_internal_error="500";
 const invalid_token='1001';
 const  invalid_arguments='1002';
//***************  USERS  *******************
const empty_name='1003';
const empty_email='1004';
const invalid_email='1005';
const invalid_name='1006';
const invalid_password='1007';
const duplicate_email='1008';
const invalid_postCode='1009';
const invalid_email_or_password='1010';
const user_not_found='1011';
//**********************************************
const invalid_category_id='1012';
const invalid_storeTo='1014';

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
        self::invalid_postCode=>"کد  بستی نامعتبر است.",
        self::invalid_email_or_password=>"ایمیل یا رمز عبور اشتباه است.",
        self::invalid_token=>"توکن ارسال شده اشتباه است.",
        self::user_not_found=>"کاربر یافت نشد.",
        self::invalid_category_id=>"شناسه دسته بندی اشتباه است.",
        self::invalid_storeTo=>"شناسه فروشگاه اشتباه است."
];
 
  static $errorsDescEn=
[
        self::bad_Request=>"Bad Request.",
        self::server_internal_error=>"Server Internal Error",
        self::empty_name =>"Name is empty.",
	self::invalid_arguments=>"Invalid Arguments.",
        self::empty_email=>"Empty Email.",
	self::invalid_email=>"Invalid Email.",
	self::invalid_name =>"Invalid Name.",
	self::invalid_password=>"Invalid Password.",
	self::duplicate_email=>"Duplicate Email!",
        self::invalid_postCode=>"Invalid Post Code.",
        self::invalid_email_or_password=>"Invalid Email or Password!",
        self::invalid_token=>"Invalid Token!",
        self::user_not_found=>"User not found!",
        self::invalid_category_id=>"Getegory ID is invalid",
        self::invalid_storeTo=>"Invalid store id"
];

public static function getErrorObjects($attributesErrors){
        $ErrorInfoList=Array();
        foreach($attributesErrors as $attributeError){
            foreach($attributeError as $error){
                 $errorInfo=new ErrorInfo();
                 $errorInfo->code=$error;
                 $errorInfo->decscriptionFa=  self::$errorsDescFA[$error];
                 $errorInfo->descriptionEn=self::$errorsDescEn[$error];
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
    $errorInfo->descriptionEn=self::$errorsDescEn[$httpCode];
    echo \yii\helpers\Json::encode(new Result(-1,$errorInfo,null));
}

public static function encodeAndReturn($statusCode,$erros,$data){
    $result=new Result($statusCode,$erros,$data);
    echo \yii\helpers\Json::encode($result);
}







}