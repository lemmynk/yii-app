<?php

namespace backend\models;

use backend\components\MActiveRecord;
use Yii;

/**
 * This is the model class for table "admin_content".
 *
 * @property int $id
 * @property string|null $name
 * @property int $lang_id
 * @property string|null $content
 * @property int $status
 * @property int $deleted
 * @property string $created_on
 * @property int $created_by
 * @property string $modify_on
 * @property int $modify_by
 */
class Content extends MActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_content';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 50],
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
            'lang_id' => 'Lang ID',
            'content' => 'Content',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'modify_on' => 'Modify On',
            'modify_by' => 'Modify By',
        ];
    }

    public static function getContentOptions()
    {
        $models = Content::find()->where([
            'deleted' => 0,
            'status' => 1,
        ])->all();
        return $models;
    }

    public static function getContentContent($id)
    {
        $model = self::findOne($id);
        return $model->content;
    }
}
