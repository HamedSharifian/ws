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
		  
		  //All Scenarios
		 // ['postCode0'  ,'integer'],
		 // [['email', 'name', 'postCode', 'phoneNumber'], 'string', 'max' => 255],



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
        }
         return parent::beforeSave($insert);

    }
}
