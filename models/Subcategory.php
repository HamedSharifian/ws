<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subcategories".
 *
 * @property integer $ID
 * @property string $SUBCATEGORY
 * @property integer $CATEGORY
 *
 * @property Mappedcategories[] $mappedcategories
 * @property Products[] $products
 * @property Categories $cATEGORY
 */
class Subcategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subcategories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'required'],
            [['ID', 'CATEGORY'], 'integer'],
            [['SUBCATEGORY'], 'string', 'max' => 255],
            [['CATEGORY'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['CATEGORY' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'SUBCATEGORY' => 'Subcategory',
            'CATEGORY' => 'Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMappedcategories()
    {
        return $this->hasMany(Mappedcategories::className(), ['subCategory' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['subCategory' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCATEGORY()
    {
        return $this->hasOne(Categories::className(), ['ID' => 'CATEGORY']);
    }
}
