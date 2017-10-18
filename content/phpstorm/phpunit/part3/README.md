# Оценка покрытия кода

Для оценки покрытия кода необходимо в файле phpunit.xml указать папку в которой находится тестируемый код. Пример:
```xml
<filter>
   <whitelist processUncoveredFilesFromWhitelist="true">
       <directory suffix=".php">./lib</directory>
   </whitelist>
</filter>
```

После этого можно запустить тесты, нажав на кнопку "Run with Coverage".
![Запуск тестов с оценкой покрытия... ](/content/phpstorm/phpunit/img/12.png)

В результате получится такая вот оценка:
![Результат... ](/content/phpstorm/phpunit/img/13.png)

В которой можно увидеть процент покрытия и если открыть тестируемый класс, наглядно видно какие участки кода протестированы, какие - нет. 


