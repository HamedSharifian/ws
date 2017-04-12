<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $ID
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
 * @property Stocks[] $stocks
 */
class Products extends \yii\db\ActiveRecord
{
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
            [['ID'], 'required'],
            [['ID', 'maxPrice', 'minPrice', 'subCategory'], 'integer'],
            [['description', 'icon'], 'string'],
            [['title', 'brand', 'barcode', 'crawlCat'], 'string', 'max' => 255],
            [['subCategory'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategories::className(), 'targetAttribute' => ['subCategory' => 'ID']],
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
    public function getStocks()
    {
        return $this->hasMany(Stocks::className(), ['productTo' => 'ID']);
    }
}
