<?php

namespace app\modules\admin;

class Module extends \yii\base\Module
{
    /**
     * Указываем путь директории контролеров
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    public $layout = '/admin';

    /**
     * Инициализация модуля admin
     */
    public function init()
    {
        parent::init();

    }
}
