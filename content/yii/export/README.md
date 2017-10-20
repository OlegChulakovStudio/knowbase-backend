# Экспорт

- [Подключить и использовать расширение Yii2 Export](https://github.com/kartik-v/yii2-export)
- Подключить модуль в конфигурации приложения
```
'modules' => [
   'gridview' =>  [
        'class' => '\kartik\grid\Module'
    ]
],
```

## Пример экспортирования в Excel
Конфигурация columns для GridView:
```
<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

    'email:email',
    'created_at',

    [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{delete}'
    ],
];
?>

```

Вывод кнопки экспорта в Excel:
```
<ul class="list-unstyled">
        <?=
        ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'fontAwesome' => true,
            'asDropdown' => false,
            'target' => ExportMenu::TARGET_SELF,
            'showConfirmAlert' => false,
            'clearBuffers' => true,
            'filename' => $this->title,
            'exportConfig' => [
                ExportMenu::FORMAT_CSV => false,
                ExportMenu::FORMAT_HTML => false,
                ExportMenu::FORMAT_TEXT => false,
                ExportMenu::FORMAT_PDF => false,
                ExportMenu::FORMAT_EXCEL => false,
                ExportMenu::FORMAT_EXCEL_X => [
                    'label' => 'Экспортировать в Excel',
                    'linkOptions' => [
                        'class' => 'btn btn-success'
                    ],
                ],
            ],
        ])
        ?>
</ul>

```

Вывод GridView который необходимо экспортировать:
```
 <?= \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
    ]); 
 ?>
```