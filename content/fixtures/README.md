# Фикстуры

http://www.yiiframework.com/doc-2.0/guide-test-fixtures.html

## Создание фикстур
Мы обычно располагаем фикстуры в папке common/fixtures.
Пример фикстуры:
```
namespace common\fixtures;

use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $modelClass = 'common\models\User';
}

```

Файлы с данными, которыми будет заполнена фикстура находятся в папке data, которая расположена в той же папке что и сама фикстура, то есть в common/fixtures/data. Название файла должно совпадать с названием таблицы модели фикстуры.
Пример файла common/fixtures/data/user.php
```
return [
    [
        'name' => 'Диана',
        'id' => 1,
        'is_doctor' => true,
        'telephone' => '3679113664',
        'lastname' => 'Блинов',
        'is_confirmed' => 1,
        'created_at' => '2001-01-11 05:11:08',
    ],
    [
        'name' => 'Леонид',
        'id' => 2,
        'is_doctor' => false,
        'telephone' => '5304369043',
        'lastname' => 'Лобанов',
        'is_confirmed' => 1,
        'created_at' => '1983-10-04 18:13:48',
    ],
]
```
Для генерации данных для фикстур можно использовать расширение https://github.com/fzaninotto/Faker.
Для этого нужно:
 - подключить расширение, указав путь к шаблонам и путь к данным фикстур
  ```
    'controllerMap' => [
        'fixture' => [
            'class' => \yii\faker\FixtureController::className(),
            'namespace' => 'common\fixtures',
            'templatePath' => '@common/fixtures/templates',
            'fixtureDataPath' => '@common/fixtures/data',
            'count' => 50,
            'language' => 'ru_RU'
        ],
    ]
```
 - создать шаблоны данных. Мы их помещаем в директории common/fixtures/template . Имена файлов сопадают с названием таблиц фикстур.
Пример :
```
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'name' => $faker->firstName,
    'id' => $index +1 ,
    'is_doctor' => (int) ($index % 2 == 0),
    'telephone' => $faker->numerify('##########'),
    'lastname' => $faker->lastName,
    'is_confirmed' => $index < 5 ? 1 : $faker->numberBetween(0,1),
    'created_at' => $faker->dateTime->format('Y-m-d H:i:s'),
];
```

## Генерация и загрузка фикстур
- генерация фикстур. На основании шаблонов создаются файлы с сгенерированными данными
```
php yii fixture/generate-all 
```
- загрузка фикстур в базу
```
php yii fixture/load "User, UserAuth"
```
