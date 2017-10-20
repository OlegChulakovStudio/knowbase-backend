# Выпадающий фильтр в админке


![alt text](/content/yii/filter_grud_disign/files/example.png)

- Вывести вьюшку поиска
```
Collapse::widget([
		'encodeLabels'	=>	false,
		'items'	=>	[
			[
				'label'		=>	'Фильтр',
				'content'	=>	$this->render('_search', ['model' => $searchModel]),
				'contentOptions' => [
					'class' => Yii::$app->request->get('StockSearch')?'in':''
				],
			]
		]
	]);

```