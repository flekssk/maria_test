<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Модуль загрузки файлов на сервер.
 * @property $file - объект UploadedFile содержащий данные о загруженом файле
 * @property $uploadDir - Директория загрузки файла
 */

class UploadFile extends Model
{
    public $file;
    public $uploadDir;

    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->uploadDir = \Yii::getAlias('@web') . 'uploads/';
    }

    /**
     * Загрузка файла.
     * Если передается имя текущего файла то удаляет его
     * @return string - Имя загруженного файла
     */
    public function saveFile(UploadedFile $file, $currentImage = null )
    {
        if( $currentImage && file_exists( $this->uploadDir . $currentImage ) )
        {
            unlink( $this->uploadDir . $currentImage );
        }

        $fileName = time() . "." . $file->extension;

        $file->saveAs( $this->uploadDir . $fileName );

        return $fileName;
    }
}