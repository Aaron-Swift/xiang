<?php

namespace xiang\crud;

use Yii;

/**
 * Deletes an existing model
 *
 * @since 1.0
 */
class DeleteAction extends Action
{
    /**
     * @var string
     */
    public $param = 'id';
    /**
     * @var string
     */
    public $redirect;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->findModel(Yii::$app->request->get($this->param))->delete();

        return $this->controller->redirect(Yii::$app->request->referrer);
    }
}
