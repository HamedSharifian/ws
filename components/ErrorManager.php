<?php
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class ErrorManager extends Component{
const invalid_arguments='invalid_arguments';
//***************  USERS  *******************
const invalid_email='invalid_email';
const invalid_name='invalid_name';
const invalid_password='invalid_password';
const duplicate_email='invalid_email';
//**********************************************
const errors=
[
	invalid_arguments=>900,
	invalid_email=>1001,
	invalid_name =>1002,
	invalid_password=>1003,
	duplicate_email=>1004
];

}

?>