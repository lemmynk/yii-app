<?php
/**
 * Created by PhpStorm.
 * User: miller
 * Date: 19/12/23
 * Time: 17:31
 */

namespace backend\components;


use backend\models\User;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii;

class MActiveRecord extends ActiveRecord
{
    const STATUS_DELETED = 1;
    const STATUS_NOT_DELETED = 0;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;


    public function getStatusText($status)
    {
        $ret = '';
        switch ($status) {
            case self::STATUS_ACTIVE:
                $ret = 'Active';
                break;

            case self::STATUS_INACTIVE:
                $ret = 'Inactive';
                break;
        }
        return $ret;
    }

    public function getDeletedText($deleted)
    {
        $ret = '';
        switch ($deleted) {
            case self::STATUS_NOT_DELETED:
                $ret = 'Not deleted';
                break;

            case self::STATUS_DELETED:
                $ret = 'Deleted';
                break;
        }
        return $ret;
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_on',
                'updatedAtAttribute' => 'modify_on',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function beforeValidate()
    {
        if($this->isNewRecord){
            $this->created_by = $this->modify_by = Yii::$app->user->identity->id;
        }
        else{
            $this->modify_by = Yii::$app->user->identity->id;
        }
        return parent::beforeValidate();
    }

    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getEditor()
    {
        return $this->hasOne(User::class, ['id' => 'modify_by']);
    }

    public static function formatDate($date)
    {
        $date1 = date_create($date);
        $formatDate = date_format($date1, 'd.m.Y');
        return $formatDate;
    }

    public function softDelete()
    {
        $this->deleted = self::STATUS_DELETED;
        $this->save();
        return true;
    }
}