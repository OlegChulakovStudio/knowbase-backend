# Работа с датами и временем

При работе с датами мы работаем следующим образом:
- поле в админке создаем типа unsigned integer
- при отоображении пользуемся функционалом [yii2](http://www.yiiframework.com/doc-2.0/guide-output-formatting.html).  
- в базе настрйоки временной зоны должны быть UTC. В базе хранится timestamp в часовом поясе UTC
- в настройках приложения указываем нужный нам часовой пояс
```
'timeZone' => 'Asia/Tbilisi',
```
- Теперь при отображении пользуемся функцией:  
```
Yii::$app->fromatter->asDate
```
при сохранении время введенное пользователем переводим в timestamp UTC следующим образом:
```
Yii::$app->formatter->asTimestamp($value . ' ' . Yii::$app->timeZone)
```
$value это время которое ввел пользователь к примеру '2017-12-12 12:12:12'. 
Функция переведет это время из временной зоны приложения в UTC в TIMESTAMP 
- Можно воспользоваться поведением AttributeBehavior. Пример:
```
    /**
     * @return array
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'finished_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'finished_at',
                    ActiveRecord::EVENT_AFTER_FIND => 'finished_at'
                ],
                'value' => function ($event) {
                    if (!$this->finished_at) {
                        return $this->finished_at;
                    }

                    if ($event->name == ActiveRecord::EVENT_AFTER_FIND) {
                        return Yii::$app->formatter->asDate($this->finished_at, 'php:d.m.Y H:i:s');
                    }

                    return Yii::$app->formatter->asTimestamp($this->finished_at . ' ' . Yii::$app->timeZone);
                },
            ],
        ];
    }
```