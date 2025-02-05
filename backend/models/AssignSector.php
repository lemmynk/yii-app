<?php

namespace backend\models;

use backend\components\MActiveRecord;
use Yii;

/**
 * This is the model class for table "admin_assign_sector".
 *
 * @property int $id
 * @property string $lang_id
 * @property int $page_id
 * @property int $sector_id
 * @property int $order_by
 * @property int $status
 * @property int $deleted
 * @property string $created_on
 * @property int $created_by
 * @property string $modify_on
 * @property int $modify_by
 */
class AssignSector extends MActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_assign_sector';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_id', 'sector_id', 'order_by', ], 'required'],
            [['assign_type'], 'string'],
            [['page_id', 'sector_id', 'order_by', 'status'], 'integer'],
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

    public function getSctr()
    {
        return $this->hasOne(Sector::className(), ['id' => 'sector_id']);
    }

    public function getSector($id)
    {
        return Sector::findOne(['id' => $id]);
    }
}
