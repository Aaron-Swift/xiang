<?php

namespace xiang\crud;

use Yii;
use yii\base\InvalidConfigException;

/**
 * CRUD
 *
 */
class Controller extends \yii\web\Controller
{
    /**
     * @var string the model class name. This property must be set.
     */
    public $modelClass;
    /**
     * @var string the search model class name.
     */
    public $searchModelClass;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->modelClass === null) {
            throw new InvalidConfigException('The "modelClass" property must be set.');
        }
    }

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'index'  => ['GET'],
            'view'   => ['GET'],
            'create' => ['POST'],
            'update' => ['POST', 'PUT'],
            'delete' => ['GET', 'DELETE'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index'  => [
                'class' => IndexAction::className(),
                'modelClass' => $this->searchModelClass ?: $this->modelClass,
            ],
            'view'  => [
                'class' => ViewAction::className(),
                'modelClass' => $this->modelClass,
            ],
            'create'  => [
                'class' => CreateAction::className(),
                'modelClass' => $this->modelClass,
            ],
            'update'  => [
                'class' => UpdateAction::className(),
                'modelClass' => $this->modelClass,
            ],
            'delete'  => [
                'class' => DeleteAction::className(),
                'modelClass' => $this->modelClass,
            ],
        ];
    }
}
