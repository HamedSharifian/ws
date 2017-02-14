<?php
namespace app\components;

use yii\base\Component;
use Yii;

class ErrorManager extends Component{
    
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

public static function finishWithError($httpCode){
   Yii::$app->response->statusCode = $httpCode;
    switch($httpCode){
        case 400: { echo"Bad Request, Payload not found!" ;  }
        case 500: {echo"Internal Server Error!" ;  }
    }
}


}