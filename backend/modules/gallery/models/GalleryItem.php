<?php

namespace app\modules\gallery\models;

use backend\components\MActiveRecord;
use common\helpers\Myfunctions;
use Yii;

/**
 * This is the model class for table "mod_gallery_item".
 *
 * @property int $id
 * @property string $name
 * @property string $category_id
 * @property string $type
 * @property string|null $ext
 * @property string $seo_name
 * @property int $status
 * @property int $deleted
 * @property string $created_on
 * @property int $created_by
 * @property string $modify_on
 * @property int $modify_by
 */
class GalleryItem extends MActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mod_gallery_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'deleted','category_id'], 'integer'],
            [['name'], 'string', 'max' => 1024],
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
            'category_id' => 'Category ID',
            'type' => 'Type',
            'ext' => 'Ext',
            'seo_name' => 'Seo Name',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'modify_on' => 'Modify On',
            'modify_by' => 'Modify By',
        ];
    }
}
