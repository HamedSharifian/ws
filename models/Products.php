<?php

namespace app\models;

use Yii;
use app\components\ErrorManager;
/**
 * This is the model class for table "products".
 *
 * @property string $ID
 * @property string $title
 * @property string $brand
 * @property integer $maxPrice
 * @property integer $minPrice
 * @property string $description
 * @property string $icon
 * @property string $barcode
 * @property string $crawlCat
 * @property integer $subCategory
 *
 * @property Favorites[] $favorites
 * @property Subcategories $subCategory0
 * @property Shoppinglists[] $shoppinglists
 * @property Stocks[] $stocks
 */
class Products extends \yii\db\ActiveRecord
{
    
     const SCENARIO_GET_PRODUCT="GET_PRODUCT";

    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
       return [
            [['ID'], 'required','on'=>self::SCENARIO_GET_PRODUCT,'message'=>  ErrorManager::invalid_product_id],
            [['ID'], 'integer' ,'on'=>self::SCENARIO_GET_PRODUCT,'message'=>  ErrorManager::invalid_product_id],
            [['ID'],'checkProductExistance','on'=>self::SCENARIO_GET_PRODUCT]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'title' => 'Title',
            'brand' => 'Brand',
            'maxPrice' => 'Max Price',
            'minPrice' => 'Min Price',
            'description' => 'Description',
            'icon' => 'Icon',
            'barcode' => 'Barcode',
            'crawlCat' => 'Crawl Cat',
            'subCategory' => 'Sub Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorites::className(), ['productTo' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategory0()
    {
        return $this->hasOne(Subcategories::className(), ['ID' => 'subCategory']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShoppinglists()
    {
        return $this->hasMany(Shoppinglists::className(), ['productTo' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stocks::className(), ['productTo' => 'ID']);
    }
    
    
    function checkProductExistance(){
        if(!$this->find()->where(["ID"=>$this->ID])->exists()){
             $this->addError('ID',  ErrorManager::product_not_found);
        }
    }
}
