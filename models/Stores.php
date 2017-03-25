<?php

namespace app\models;

use Yii;

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
            [['ID'], 'required'],
            [['ID', 'rial'], 'integer'],
            [['link'], 'string'],
            [['name', 'logo'], 'string', 'max' => 255],
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

