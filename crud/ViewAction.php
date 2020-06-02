<?php

namespace xiang\crud;

use Yii;

class ViewAction extends Action
{
    /**
     * @var string
     */
    public $param = 'id';

    /**
     * @inheritdoc
     */
    public function run()
    {
        $id = Yii::$app->request->get($this->param);
        
        return $this->renderHtmlResponse([
            'model' => $this->findModel($id),
        ]);
    }
}
