<?php

namespace xiang\crud;

use Yii;

class CreateAction extends Action
{
    /**
     * @var string
     */
    public $redirect;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $model = new $this->modelClass;
        $model->loadDefaultValues();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            if ($this->redirect) {
                $redirect = $this->redirect;
            } else {
                $actions = $this->controller->actions();
                $redirect = isset($actions['view']) ? ['view'] : ['index'];
            }

            return $this->controller->redirect($redirect);
        }

        return $this->renderHtmlResponse([
            'model' => $model,
        ]);
    }
}
