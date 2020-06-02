<?php

namespace xiang\db;

use Yii;
use yii\behaviors\TimestampBehavior;
use xiang\behaviors\SoftDeleteBehavior;

/**
 * base active record
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = [
            'timestamp' => [
                'class' => TimestampBehavior::className()
            ],
        ];

        // set soft delete switch and set feild
        if (SOFT_DELETE_SWITCH && isset(static::getTableSchema()->columns['deleted_at'])) {
            $behaviors['softDelete'] = [
                'class' => SoftDeleteBehavior::className()
            ];
        }
        return $behaviors;
    }

    /**
     * {@inheritdoc}
     * @return ActiveQuery the newly created [[ActiveQuery]] instance.
     */
    public static function find()
    {
        return Yii::createObject(ActiveQuery::className(), [get_called_class()]);
    }

    /**
     * not found exception
     * @param $condition
     * @return null|static
     * @throws NotFoundException
     */
    public static function findOrFail($condition)
    {
        if (($model = static::findOne($condition)) !== null) {
            return $model;
        }

        throw new NotFoundException('not found the model');
    }

    /**
     * @inheritdoc
     */
    protected function createRelationQuery($class, $link, $multiple)
    {
        if (strpos($class, '\\') === false) {
            $class = substr(static::className(), 0, strrpos(static::className(), '\\') + 1) . $class;
        }

        return parent::createRelationQuery($class, $link, $multiple);
    }
}
