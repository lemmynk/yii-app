<?php

namespace backend\modules\listing\models;

use backend\components\MActiveRecord;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "mod_listing_category".
 *
 * @property int $id
 * @property string|null $cat_title
 * @property string|null $cat_seo
 * @property string|null $description
 * @property int $status
 * @property int $created_by
 * @property string $created_on
 * @property int $modify_by
 * @property string $modify_on
 * @property int $deleted
 */
class ListingCategory extends MActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mod_listing_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['status', 'deleted'], 'integer'],
            [['created_on', 'modify_on', 'created_by', 'modify_by'], 'safe'],
            [['cat_title', 'cat_seo'], 'string', 'max' => 100],
            [['cat_title'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_title' => 'Title',
            'cat_seo' => 'Cat Seo Name',
            'description' => 'Description',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'modify_by' => 'Modify By',
            'modify_on' => 'Modify On',
            'deleted' => 'Deleted',
        ];
    }

    public static function getCategoryPk()
    {
        $ret = [];
        $models = ListingCategory::find()
            ->where([
                'status' => 1,
                'deleted' => 0])
            ->orderBy(['id' => SORT_ASC])
            ->all();

        foreach ($models as $model){
            $ret = $model->id;
        }
        return $ret;
    }

    public static function findModelByPk($id)
    {
        $model = ListingCategory::findOne($id);
        return $model;
    }

    public static function findModelByFilename($cat_seo)
    {
        $model = self::findOne(['cat_seo' => $cat_seo]);
        return $model;
    }

    public static function getCategoryOptions()
    {
        $categories = self::find()->where(
            ['status' => 1,
            'deleted' => 0
        ])->select(['id', 'cat_title',
        ])->all();

        //$arr = ArrayHelper::toArray($categories, ['id', 'cat_title']);
        return ArrayHelper::map($categories, 'id', 'cat_title');
    }
}
