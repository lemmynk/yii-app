<?php

namespace backend\modules\menu\models;

use backend\components\MActiveRecord;
use Yii;

/**
 * This is the model class for table "mod_menu_item".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $url
 * @property int $is_parent
 * @property int $parent_id
 * @property int $status
 * @property int $created_by
 * @property string $created_on
 * @property int $modify_by
 * @property string $modify_on
 */
class MenuItem extends MActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mod_menu_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'is_parent', 'parent_id', 'status'], 'integer'],
            [['name', 'url'], 'required'],
            [['created_on', 'modify_on', 'created_by', 'modify_by'], 'safe'],
            [['name', 'url'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'url' => 'Url',
            'is_parent' => 'Is Parent',
            'parent_id' => 'Parent ID',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'modify_by' => 'Modify By',
            'modify_on' => 'Modify On',
        ];
    }
}
