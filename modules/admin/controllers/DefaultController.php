<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

/**
 * Констроллер по умолчанию для админки
 */
class DefaultController extends Controller
{
    /**
     * Выводит вид index
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
