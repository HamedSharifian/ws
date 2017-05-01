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
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
        const SCENARIO_GETALL="GetAll";
        const SCENARIO_GET_STOKCS="GETSTOCKS";

    
    
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
              ['MAIN_CATEGORY'	,'required','on'=>self::SCENARIO_GETALL,'message'=> ErrorManager::invalid_category_id],
              ['MAIN_CATEGORY'	,'integer' ,'on'=>self::SCENARIO_GETALL,'message'=> ErrorManager::invalid_category_id],
              ['ID'	,'required','on'=>self::SCENARIO_GET_STOKCS,'message'=> ErrorManager::invalid_category_id],
              ['ID'	,'integer' ,'on'=>self::SCENARIO_GET_STOKCS,'message'=> ErrorManager::invalid_category_id],

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
            'MAIN_CATEGORY' => 'Main Category',
        ];
    }
}
