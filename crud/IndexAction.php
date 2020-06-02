<?php

namespace xiang\crud;

use Yii;
use yii\web\Response;

class IndexAction extends Action
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        $searchModel = new $this->modelClass;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $dataProvider->models;
        }

        return $this->renderHtmlResponse([
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
