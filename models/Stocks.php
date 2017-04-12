<?php

namespace app\models;

use Yii;
use app\components\ErrorManager;

/**
 * This is the model class for table "stocks".
 *
 * @property integer $ID
 * @property string $validDate
 * @property integer $price
 * @property string $title
 * @property integer $discount
 * @property integer $minAmount
 * @property string $link
 * @property string $image
 * @property integer $productTo
 * @property integer $storeTo
 *
 * @property Products $productTo0
 * @property Stores $storeTo0
 */
class Stocks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     * 
     */
    
     const SCENARIO_GET_BEAST_DEALS="GETBESTDEALS";

    
    
    public static function tableName()
    {
        return 'stocks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['storeTo'], 'required','on'=>self::SCENARIO_GET_BEAST_DEALS,'message'=>  ErrorManager::invalid_storeTo],
            [['storeTo'], 'integer' ,'on'=>self::SCENARIO_GET_BEAST_DEALS,'message'=>  ErrorManager::invalid_storeTo],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'validDate' => 'Valid Date',
            'price' => 'Price',
            'title' => 'Title',
            'discount' => 'Discount',
            'minAmount' => 'Min Amount',
            'link' => 'Link',
            'image' => 'Image',
            'productTo' => 'Product To',
            'storeTo' => 'Store To',
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
    public function getStoreTo0()
    {
        return $this->hasOne(Stores::className(), ['ID' => 'storeTo']);
    }
}
