<?php

namespace backend\models;

use backend\components\MActiveRecord;
use common\helpers\Myfunctions;
use Yii;

/**
 * This is the model class for table "admin_template".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $deleted
 * @property string $created_on
 * @property int $created_by
 * @property string $modify_on
 * @property int $modify_by
 */
class Template extends MActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
            [['created_on', 'modify_on'], 'safe'],
            [['name'], 'string', 'max' => 100],
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
            'status' => 'Status',
            'deleted' => 'Deleted',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'modify_on' => 'Modify On',
            'modify_by' => 'Modify By',
        ];
    }

    /**
     * Options for templates when creating a page
     * @return array
     */
    public static function getTemplateOptions()
    {
        $models = Template::findAll(['status' => 1, 'deleted' => 0]);
        $opts = [];
        foreach ($models as $model){
            $opts[$model->id] = $model->name;
        }
        return $opts;
    }

    /**
     * Relation between template and sectors
     * @return \yii\db\ActiveQuery
     */
    public function getSectors()
    {
        return $this->hasMany(Sector::class, ['tpl_id' => 'id']);
    }

    public function getTemplateContent($urls)
    {
        //$sectors = [];
        $contents = [];
        //$template = $this->getTemplate($id);
        $sectors = Sector::find()->where([
            'deleted' => 0,
            'status' => 1,
            'tpl_id' => $this->id,
            'sector_type' => 'T',
        ])->all();

        foreach ($sectors as $sector){
            $contents['fileName'] = $sector->file_name;
            $contents['content'] = $sector->getSectorContent($sector->id, $urls);

            $ret[] = $contents;
            unset($contents);
        }

        return $ret;
    }
}
