<?php

namespace backend\models;

use backend\components\MActiveRecord;
use Yii;

/**
 * This is the model class for table "admin_assign_content".
 *
 * @property int $id
 * @property string $lang_id
 * @property string $content_type
 * @property int $content_id
 * @property int $sector_id
 * @property int $page_id
 * @property int $order_by
 * @property int $status
 * @property int $deleted
 * @property string $created_on
 * @property int $created_by
 * @property string $modify_on
 * @property int $modify_by
 */
class AssignContent extends MActiveRecord
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
            [['content_type'], 'string'],
            [['content_id', 'page_id', 'sector_id', 'order_by', 'status', 'deleted'], 'integer'],
            [['created_on', 'modify_on', 'created_by', 'modify_by', 'order_by'], 'safe'],
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
            'content_type' => 'Content Type',
            'content_id' => 'Content',
            'sector_id' => 'Sector',
            'page_id' => 'Page',
            'order_by' => 'Order By',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'modify_on' => 'Modify On',
            'modify_by' => 'Modify By',
        ];
    }

    public function getContent()
    {
        return $this->hasOne(Content::class, ['id' => 'content_id']);
    }

    public function getWidget()
    {
        return $this->hasOne(Widget::class, ['id' => 'content_id']);
    }

    public function getSector()
    {
        return $this->hasOne(Sector::class, ['id' => 'sector_id']);
    }

    public function getPage()
    {
        return $this->hasOne(Pages::class, ['id' => 'page_id']);
    }

    public function getOneContent($id)
    {
        $content = Content::findOne(['id' => $id]);
        return $content;
    }

    public function getContentTypeOptions()
    {
        return ['C' => 'Content', 'W' => 'Widget'];
    }

    public function getContentTypeText()
    {
        if ($this->content_type === 'C'){
            return 'Content';
        }
        else
            return 'Widget';
    }

    public function getAssignedContent()
    {
        //return $this->getContent()->where()->all();
    }
}
