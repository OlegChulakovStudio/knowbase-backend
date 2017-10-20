## Склонение по падежам
Пример:
```
    /**
     * Получить текст в дательном падеже
     * @param $name string
     * @return string
     */
    public static function getNameDativeCase($name)
    {
        try {
            $xmlData = @file_get_contents('http://api.morpher.ru/WebService.asmx/GetXml?s='.urlencode($name));
            $xml = simplexml_load_string($xmlData);

            return (string) $xml->Д ?: $name;
        } catch (Exception $e) {
            return $name;
        }

    }
```

## Множественное, единственное число для числительных

В языковом файле прописать
```
return [
    'countManagers' => ' {count, plural, one{сотрудник} few{сотрудника} many{сотрудников} other{сотрудника}}',
];
```

Пример использования:

```
Yii::t('app', 'countManagers', ['count' => $countManagers])
```