<?php

namespace backend\models;

use backend\components\MActiveRecord;
use Yii;

/**
 * This is the model class for table "admin_assign".
 *
 * @property int $id
 * @property string $lang_id
 * @property string $assign_type
 * @property int $page_id
 * @property string $content_type
 * @property int $content_id
 * @property int $sector_id
 * @property int $order_by
 * @property int $status
 * @property int $deleted
 * @property string $created_on
 * @property int $created_by
 * @property string $modify_on
 * @property int $modify_by
 */
class Assign extends MActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_assign';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['assign_type', 'content_type', 'content_id'], 'required'],
            [['assign_type', 'content_type'], 'string'],
            [['page_id', 'content_id', 'sector_id', 'order_by', 'status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lang_id' => 'Lang ID',
            'assign_type' => 'Assign Type',
            'page_id' => 'Page ID',
            'content_type' => 'Content Type',
            'content_id' => 'Content ID',
            'sector_id' => 'Sector ID',
            'order_by' => 'Order By',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'modify_on' => 'Modify On',
            'modify_by' => 'Modify By',
        ];
    }
}
