<?php

namespace app\models;
use Yii;
use app\components\ErrorManager;

/**
 * This is the model class for table "users".
 *
 * @property integer $ID
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string $postCode
 * @property string $phoneNumber
 * @property string $lastActivity
 * @property string $registerDate
 *  
 * @property Favorites[] $favorites
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	 const SCENARIO_REGISTER="register";
	 const SCENARIO_LOGIN="login";

       public $token; 
	 
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['ID'], 'required'],
           // [['ID'], 'integer'],
          //  [['password'], 'string'],
          //  [['lastActivity', 'registerDate'], 'safe'],
		  
		  // Scenario Register
                  ['name'		,'required','on'=> self::SCENARIO_REGISTER,'message'=> ErrorManager::empty_name],
		  ['email'		,'required','on'=> self::SCENARIO_REGISTER,'message'=> ErrorManager::empty_email],
		  ['email'		,'email'   ,'on'=> self::SCENARIO_REGISTER,'message'=> ErrorManager::invalid_email],
		  ['email'		,'unique'  ,'on'=> self::SCENARIO_REGISTER,'message'=> ErrorManager::duplicate_email],
		  ['password'	,'required','on'=> self::SCENARIO_REGISTER,'message'=> ErrorManager::invalid_password],
		  ['password'	,'string'  ,'min'=>1 , 'on'=>self::SCENARIO_REGISTER,'message'=> ErrorManager::invalid_password],
		  ['postCode'	,'required','on'=>self::SCENARIO_REGISTER,'message'=> ErrorManager::invalid_postCode],
		  ['token'	,'required','on'=>self::SCENARIO_REGISTER,'message'=> ErrorManager::invalid_token],
		  ['token'	,'tokenvalidator','on'=>self::SCENARIO_REGISTER,'message'=> ErrorManager::invalid_token],

            
		  ['email'	,'required'        ,'on'=> self::SCENARIO_LOGIN,'message'=> ErrorManager::empty_email],
		  ['email'      ,'email'           ,'on'=> self::SCENARIO_LOGIN,'message'=> ErrorManager::invalid_email],
		  ['password'	,'required'        ,'on'=> self::SCENARIO_LOGIN,'message'=> ErrorManager::invalid_password],
		  ['password'	,'authenticate'          ,'on'=> self::SCENARIO_LOGIN,'message'=> ErrorManager::invalid_password],
                  ['token','safe']


        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'email' => 'Email',
            'name' => 'Name',
            'password' => 'Password',
            'postCode' => 'Post Code',
            'phoneNumber' => 'Phone Number',
            'lastActivity' => 'Last Activity',
            'registerDate' => 'Register Date',
        ];
    }
    
    
    public function authenticate(){
        if(!$this->hasErrors())  // we only want to authenticate when no input errors
                {
                       $savedPass = Yii::$app->db->createCommand("select password from users where email='".$this->email."'")->queryOne();
                       if($savedPass==null || !hash_equals($savedPass['password'], $this->getHash($this->password))){
                          $this->addError('email',  ErrorManager::invalid_email_or_password);
                       }
                }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorites::className(), ['userTo' => 'ID']);
    }
    
    public function beforeSave($insert) {
        if($this->isNewRecord){
            $max = Yii::$app->db->createCommand(' select max(ID) as max from users')->queryScalar();
            $ID = ($max + 1);
            $this->ID=$ID;
            $this->registerDate=date('Y-m-d H:i:s');
            $this->password=self::getHash($this->password);
        }
         return parent::beforeSave($insert);
    }
    
    function getHash($password){
        return crypt($password,"$3$084t09544&543hHs#$");
    }
    
    function getToken($email,$password){
        echo hash_hmac("SHA256", $email.$password, "uYC0NI9/d365edDw#&Z;jsadlj",false);
        return hash_hmac("SHA256", $email.$password, "uYC0NI9/d365edDw#&Z;jsadlj",false);
    }
    
    function tokenIsValid(){
        $validToken=$this->getToken($this->email,$this->password);
        return strcmp($validToken, $this->token)==0;
    }
    
    function tokenvalidator(){
        switch($this->scenario){
            case self::SCENARIO_REGISTER:{
                if(!$this->tokenIsValid()){
                     $this->addError('token',  ErrorManager::invalid_token);
                }
            }   
        }
        
    }
}
