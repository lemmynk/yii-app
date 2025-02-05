<?php

namespace backend\models;

use Codeception\PHPUnit\Constraint\Page;
use Yii;
use backend\components\MActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "admin_pages".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $url
 * @property int $tpl_id
 * @property string|null $title
 * @property string|null $keywords
 * @property string|null $description
 * @property int $lang_id
 * @property int $status
 * @property int $deleted
 * @property string $created_on
 * @property int $created_by
 * @property string $modify_on
 * @property int $modify_by
 */
class Pages extends MActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'tpl_id'], 'required'],
            [['tpl_id', 'lang_id', 'status'], 'integer'],
            [['name', 'url'], 'string', 'max' => 50],
            [['title', 'keywords', 'description'], 'string', 'max' => 255],
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
            'url' => 'Url',
            'tpl_id' => 'Template',
            'title' => 'Title',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'lang_id' => 'Lang ID',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'modify_on' => 'Modify On',
            'modify_by' => 'Modify By',
        ];
    }

    public function getTemplate()
    {
        return $this->hasOne(Template::class,['id' =>'tpl_id']);
    }

    public function getPageTemplate($id)
    {
        return Template::findOne(['id' => $id]);
    }

    public static function findPageByUrl($url)
    {
        if (($model = Pages::findOne(['url' => $url])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public static function getPageContent($urls, $id, $sectorId)
    {
        $models = AssignContent::find()->where([
            'status' => 1,
            'deleted' => 0,
            'page_id' => $id,
            'sector_id' => $sectorId
        ])->all();

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

    public static function getPagesForList()
    {
        $ret = [];
        $pgs = [];
        $pages = self::find()->where([
            'deleted' => 0,
            'status' => 1
        ])->select(['url', 'name'])->asArray()->all();

        //$pgs = ArrayHelper::map($pages, 'name', 'url');
        foreach ($pages as $pg){
            $ret['title'] = $pg['name'];
            $ret['value'] = $pg['url'];
            $pgs[] = $ret;
            unset($ret);
        } /**/
        return $pgs;
    }
}
