<?php

namespace backend\models;

use backend\components\MActiveRecord;
use common\helpers\Myfunctions;
use Yii;

/**
 * This is the model class for table "admin_template_sector".
 *
 * @property int $id
 * @property string $name
 * @property string $file_name
 * @property int $tpl_id
 * @property string $sector_type P - page , T - template
 * @property int $status
 * @property int $deleted
 * @property string $created_on
 * @property int $created_by
 * @property string $modify_on
 * @property int $modify_by
 */
class Sector extends MActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_template_sector';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'tpl_id'], 'integer'],
            [['sector_type'], 'string'],
            [['name', 'file_name'], 'string', 'max' => 100],
            [['name', 'file_name', 'sector_type', 'tpl_id'], 'required'],
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
            'file_name' => 'File Name',
            'tpl_id' => 'Template',
            'sector_type' => 'Sector Type',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'modify_on' => 'Modify On',
            'modify_by' => 'Modify By',
        ];
    }

    public function getSectorTypeText()
    {
        if ($this->sector_type === 'T'){
            return 'Template';
        } else return 'Page';
    }

    public static function getSectorsOptions()
    {
        $sectors = [];
        $models = Sector::findAll(['status' => 1, 'deleted' => 0]);
        foreach ( $models as $model){
            $sectors[$model->id] = $model->name;
        }
        return $sectors;
    }


    public function getSectorContent($id, $urls)
    {
        $models = AssignContent::find()
                        ->where(['sector_id' => $id, 'status' => 1, 'deleted' => 0])
                        ->orderBy(['order_by' => SORT_ASC])
                        ->all();
        //Myfunctions::echoArray($models);
        $content = '';
        foreach ($models as $model){
            $con = '';
            if ($model->content_type === 'C'){
                $con = Content::getContentContent($model->content_id);
            }
            elseif ($model->content_type === 'W'){
                $con = Widget::getWidgetContent($model->content_id, $urls);
            }
            $content .= $con . "\n";
            unset($con);
        }
        return $content;
    }
}
