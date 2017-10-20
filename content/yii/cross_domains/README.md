# Разрешение кросс-доменных запросов

Необходимо создать базовый класс-контроллер `Controller` (показан ниже) от которого будут наследоваться все остальные контроллеры.

```
<?php
/**
 * Файл класса-контроллера Controller
 *
 * @copyright Copyright (c) 2017, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace api\controllers;

use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Controller as BaseController;

/**
 * Базовый контроллер приложения,
 * от которого наследуются все остальные контролеры
 */
class Controller extends BaseController
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        // Добавляем заголовки ответа для сросс-доменного запроса
        $headers = Yii::$app->response->headers;
        $headers->add('Access-Control-Allow-Origin', '*');
        $headers->add('Access-Control-Allow-Headers', 'Authorization,DNT,X-CustomHeader,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type');
        $headers->add('Access-Control-Allow-Methods', 'GET,POST,OPTIONS,HEAD,TRACE,CONNECT,PATCH,DELETE');
        if (Yii::$app->request->isOptions) {
            return false;
        }
        return parent::beforeAction($action);
    }
}
```