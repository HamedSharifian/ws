<?php

namespace app\models;
use Yii;
use app\components\ErrorManager;

/**
 * This is the model class for table "favorites".
 *
 * @property integer $ID
 * @property integer $productTo
 * @property integer $userTo
 *
 * @property Products $productTo0
 * @property Users $userTo0
 */
class Favorites extends \yii\db\ActiveRecord
{
    
    const SCENARIO_ADD="ADD_FAVOURITE";
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'favorites';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['ID'], 'required'],
            [['productTo'],'required','on'=> self::SCENARIO_ADD,'message'=> ErrorManager::invalid_product_id],
            [['productTo'],'integer','on'=> self::SCENARIO_ADD,'message'=> ErrorManager::invalid_product_id],
           // [['userTo'],'required','on'=> self::SCENARIO_ADD,'message'=> ErrorManager::invalid_user_id],
          //  [['userTo'],'integer','on'=> self::SCENARIO_ADD,'message'=> ErrorManager::invalid_product_id],
            [['productTo'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['productTo' => 'ID'],'on'=>  self::SCENARIO_ADD,'message'=>  ErrorManager::product_not_found],
            [['productTo'], 'checkDuplicateFavourite', 'on'=>  self::SCENARIO_ADD,'message'=>  ErrorManager::duplicate_favourite],
          
//  [['userTo'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userTo' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'productTo' => 'Product To',
            'userTo' => 'User To',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTo0()
    {
        return $this->hasOne(Products::className(), ['ID' => 'productTo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTo0()
    {
        return $this->hasOne(Users::className(), ['ID' => 'userTo']);
    }

    /**
     * @inheritdoc
     * @return FavoritesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FavoritesQuery(get_called_class());
    }
    
    function checkDuplicateFavourite(){
         $exists = $this->find()->where(["productTo"=>$this->productTo])->andWhere(["userTo"=>  $this->userTo])->exists();
         if($exists){
            $this->addError('productTo',  ErrorManager::duplicate_favourite);
         }
    } 
}
