<?php

namespace backend\modules\menu\models;

use backend\components\MActiveRecord;
use Yii;

/**
 * This is the model class for table "mod_menu_category".
 *
 * @property int $id
 * @property string $name
 * @property string|null $filename
 * @property int $status
 * @property string $created_on
 * @property int $created_by
 * @property string $modify_on
 * @property int $modify_by
 */
class MenuCategory extends MActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mod_menu_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status', 'created_by', 'modify_by'], 'integer'],
            [['created_on', 'modify_on'], 'safe'],
            [['name', 'filename'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'filename' => 'Filename',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'modify_on' => 'Modify On',
            'modify_by' => 'Modify By',
        ];
    }
}
