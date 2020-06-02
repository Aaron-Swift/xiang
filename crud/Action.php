<?php

namespace xiang\crud;

use Yii;

class Action extends \yii\base\Action
{
    /**
     * @var string the model class name. This property must be set.
     */
    public $modelClass;
    /**
     * @var string the view file to be rendered. If not set, it will take the value of [[id]].
     */
    public $view;
    /**
     * @var string
     */
    public $param;
    /**
     * @var string
     */
    public $layout;

    /**
     * render template
     * @param array $data
     * @return string
     */
    public function renderHtmlResponse(array $data)
    {
        return $this->controller->render($this->view ?: $this->id, $data);
    }

    protected function findModel($id)
    {
        if (($model = call_user_func([$this->modelClass, 'findOne'], $id)) !== null) {
            return $model;
        }
    }
}
