<?php

namespace app\models;

use Yii;
use app\components\ErrorManager;
/**
 * This is the model class for table "subcategory1".
 *
 * @property integer $ID
 * @property string $title
 * @property integer $category
 */
class Subcategory1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
        const SCENARIO_GETALL="GetAll";

    
    
    public static function tableName()
    {
        return 'subcategory1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
              ['category'	,'required','on'=>self::SCENARIO_GETALL,'message'=> ErrorManager::invalid_category_id],
              ['category'	,'integer','on'=>self::SCENARIO_GETALL,'message'=> ErrorManager::invalid_category_id],

          //  [['ID'], 'required'],
            //[['ID', 'category'], 'integer'],
           // [['title'], 'string', 'max' => 255],
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
            'category' => 'Category',
        ];
    }
}
