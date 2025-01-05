<?php

namespace backend\models;

use backend\components\MActiveRecord;
use backend\modules\listing\models\ListingCategory;
use common\helpers\Myfunctions;
use Yii;

/**
 * This is the model class for table "admin_widget".
 *
 * @property int $id
 * @property string $name
 * @property string|null $file_name
 * @property int $type
 * @property int $module_category_id
 * @property int $status
 * @property int $deleted
 * @property string $created_on
 * @property int $created_by
 * @property string $modify_on
 * @property int $modify_by
 */
class Widget extends MActiveRecord
{
    const SELF_TYPE_LISTING = 'L';
    const SELF_TYPE_MENU = 'M';
    const SELF_TYPE_GALLERY = 'G';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_widget';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'name', 'file_name'], 'required'],
            [['module_category_id', 'status', 'deleted', 'created_by', 'modify_by'], 'integer'],
            [['created_on', 'modify_on', 'deleted', 'created_by', 'modify_by'], 'safe'],
            [['name', 'file_name'], 'string', 'max' => 100],
            [['type', ], 'string'],
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
            'type' => 'Type',
            'module_category_id' => 'Module Category ID',
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
        $this->file_name = Myfunctions::parseForSEO($this->name);
        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

    public function getWidgetTypeOptions()
    {
        return [
            $this::SELF_TYPE_LISTING => 'Listing',
            $this::SELF_TYPE_MENU => 'Menu',
            $this::SELF_TYPE_GALLERY => 'Gallery',
            ];
    }

    public function getWidgetTypeText()
    {
        $ret = '';
        switch ($this->type){
            case self::SELF_TYPE_LISTING:
                $ret = 'Listing';
                break;
            case self::SELF_TYPE_MENU:
                $ret = 'Menu';
                break;
            case self::SELF_TYPE_GALLERY:
                $ret = 'Gallery';
                break;
        }
        return $ret;
    }

    public function getModuleCategory()
    {
        return ListingCategory::findOne($this->module_category_id)->cat_title;
    }

    public static function getWidgetOptions()
    {
        $models = self::find()->where(['status' => 1, 'deleted' => 0])->all();
        return $models;
    }

    public static function getWidgetContent($id, $urls)
    {
        $ret = '';
        $model = self::findOne($id);

        //$pages = [];
        //$pageUrl = '';
        /**
         * Find page where widget is also assigned.
         * Url of that page is used in \frontend\widgets\listing\Listing::widget
         * to render one item on page with that url
         */
        $widgetAssigns = AssignContent::find()->where(['content_id' => $id])->select(['page_id'])->all();
        foreach ($widgetAssigns as $widgetAssign){
            $pages[] = Pages::findOne($widgetAssign->page_id);
        }
        foreach ($pages as $page){
            if ($page->url !== ''){
                $pageUrl = $page->url;
            }
        }
        /**
         *
         */
        if ($model->type === self::SELF_TYPE_LISTING){
            $ret = \frontend\widgets\listing\Listing::widget([
                'options' => ['category' => $model->module_category_id],
                'urls' => $urls,
                'secondPageUrl' => $pageUrl,
                ]);
        }
        elseif ($model->type === self::SELF_TYPE_MENU){
            $ret = \frontend\widgets\navigationMenu\NavigationMenu::widget([]);
        }
        elseif ($model->type === self::SELF_TYPE_GALLERY){
            $ret = \frontend\widgets\gallery\Gallery::widget([]);
        }
        return $ret;
    }

}
