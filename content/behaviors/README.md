# Поведения

- [Ссылка на документацию](http://www.yiiframework.com/doc-2.0/guide-concept-behaviors.html)

Поведения (behaviors) — это экземпляры класса yii\base\Behavior или класса, унаследованного от него. Поведения, также известные как примеси, позволяют расширять функциональность существующих компонентов без необходимости изменения дерева наследования. После прикрепления поведения к компоненту, его методы и свойства "внедряются" в компонент, и становятся доступными так же, как если бы они были объявлены в самом классе компонента. Кроме того, поведение может реагировать на события, создаваемые компонентом, что позволяет тонко настраивать или модифицировать обычное выполнение кода компонента.

## Использование поведения TimestampBehavior

yii\behaviors\TimestampBehavior — поведение, которое позволяет автоматически обновлять атрибуты с метками времени при сохранении Active Record моделей через insert(), update() или save().
 
Для начала, необходимо прикрепить поведение к классу Active Record, в котором это необходимо:
```
namespace app\models\User;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class User extends ActiveRecord
{
    // ...

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }
}

```
Конфигурация выше описывает следующее:

- при вставке новой записи поведение должно присвоить текущую метку времени UNIX атрибутам created_at и updated_at

- при обновлении существующей записи поведение должно присвоить текущую метку времени UNIX атрибуту updated_at

Теперь, если сохранить объект User, то в его атрибуты created_at и updated_at будут автоматически установлены значения метки времени UNIX на момент сохранения записи:
```
$user = new User;
$user->email = 'test@example.com';
$user->save();
echo $user->created_at;  // выведет метку времени на момент сохранения записи

```
Поведение TimestampBehavior так же содержит полезный метод touch(), который устанавливает текущую метку времени указанному атрибуту и сохраняет его в базу данных:
```
$user->touch('login_time');
```


## Использование поведения AttributeBehavior

yii\behaviors\AttributeBehavior — поведение, которое позволяет автоматически задавать указанное значение одному или нескольким атрибутам ActiveRecord при срабатывании определённых событий.
 
Для начала, необходимо прикрепить поведение к классу Active Record, в котором это необходимо:
```
namespace app\models\User;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class User extends ActiveRecord
{
    // ...

    public function behaviors()
    {
        return [
                [
                    'class' => AttributeBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => 'attribute1',
                        ActiveRecord::EVENT_BEFORE_UPDATE => 'attribute2',
                    ],
                    'value' => function ($event) {
                        return 'some value';
                    },
                ],
            ];
    }
}

```
Конфигурация выше описывает следующее:

- при вставке новой записи поведение должно присвоить атрибуту attribute1 значение 'some value'

- при обновлении существующей записи поведение должно присвоить атрибуту attribute2 значение 'some value'

Теперь, если сохранить объект User, то в его атрибут attribute1 будет автоматически установлено значение 'some value':
```
$user = new User;
$user->email = 'test@example.com';
$user->save();
echo $user->attribute1;  // выведет 'some value'

```