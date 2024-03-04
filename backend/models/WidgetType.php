<?php

namespace backend\models;

use backend\components\MActiveRecord;
use common\helpers\Myfunctions;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "admin_widget_type".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $filename
 * @property int $status
 * @property int $deleted
 * @property string $created_on
 * @property int $created_by
 * @property string $modify_on
 * @property int $modify_by
 */
class WidgetType extends MActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_widget_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'deleted', 'created_by', 'modify_by'], 'integer'],
            [['created_on', 'modify_on', 'modify_by', 'created_by'], 'safe'],
            [['name'], 'required'],
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
            'deleted' => 'Deleted',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'modify_on' => 'Modify On',
            'modify_by' => 'Modify By',
        ];
    }


    public function beforeValidate()
    {
        $this->filename = Myfunctions::parseForSEO($this->name);
        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

    public static function getWidgetTypeOptions()
    {
        $types = WidgetType::find()->where(['status' => 1, 'deleted' => 0])->select(['id', 'name'])->all();
        $arr = ArrayHelper::toArray($types, ['id', 'name']);
        return ArrayHelper::map($arr, 'id', 'name');
    }
}
