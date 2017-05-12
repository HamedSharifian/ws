<?php

namespace app\models;

use Yii;
use app\components\ErrorManager;

/**
 * This is the model class for table "stores".
 *
 * @property integer $ID
 * @property string $name
 * @property string $logo
 * @property string $link
 * @property integer $rial
 * @property Stocks[] $stocks
**/
class Stores extends \yii\db\ActiveRecord
{
    
    const SCENARIO_GET_STOKCS="Get_Stocks";
    const SCENARIO_GET_FAVOURTIES="Get_ALL_FAVOURTITES";


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
              ['ID'	,'required','on'=>self::SCENARIO_GET_STOKCS,'message'=> ErrorManager::invalid_store_id],
              ['ID'	,'integer' ,'on'=>self::SCENARIO_GET_STOKCS,'message'=> ErrorManager::invalid_store_id],
              ['ID'	,'required','on'=>self::SCENARIO_GET_STOKCS,'message'=> ErrorManager::invalid_store_id],
              ['ID'	,'integer' ,'on'=>self::SCENARIO_GET_STOKCS,'message'=> ErrorManager::invalid_store_id],
              ['ID'	,'required','on'=>self::SCENARIO_GET_STOKCS,'message'=> ErrorManager::invalid_store_id],
              ['ID'	,'checkStoreExistnce' ,'on'=>self::SCENARIO_GET_STOKCS,'message'=> ErrorManager::invalid_store_id],
            //[['ID', 'rial'], 'integer'],
            //[['link'], 'string'],
            //[['name', 'logo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'name' => 'Name',
            'logo' => 'Logo',
            'link' => 'Link',
            'rial' => 'Rial',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stocks::className(), ['storeTo' => 'ID']);
    }
    
    
     function checkStoreExistnce(){
         $user = $this->find()->where("ID=".$this->ID);
         if($user==null){
            $this->addError('ID',  ErrorManager::invalid_store_id);
         }
    }

}