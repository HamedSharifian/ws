<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maincategories".
 *
 * @property integer $ID
 * @property string $Main_CATEGORY
 * @property string $icon
 */
class MainCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'maincategories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'required'],
            [['ID'], 'integer'],
            [['Main_CATEGORY', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'MAIN_CATEGORY' => 'Main Category',
            'icon' => 'Icon',
        ];
    }
}
