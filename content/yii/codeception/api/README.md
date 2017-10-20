# Функциональное тестирование API

## Подключение и настройка ApiTester
- http://codeception.com/for/yii
- http://codeception.com/docs/10-WebServices#REST

В шаблонах которые мы используем, использование тестов идет из под коробки. В комплект входят функциональные тесты, unit тесты.
Для тестирования API необходимо использовать APITester. 
Для этого нужно выполнить команду:
```
./vendor/bin/codecept g:suite api
```
которая создаст конфигурацию api.suite.yml.  
Пример отредактированной конфигурации:
```
class_name: ApiTester
modules:
    enabled:
      - REST:
          url: /
          depends: Yii2
      - Yii2:
          part: [fixtures, orm]

      - \backend\tests\Helper\Api
    config:
      - Yii2
```
- Класс backend\tests\Helper\Api можно расширять методами которые потом будут доступны в классах тестах
- "part: fixtures" - подключает функционал по использованию фикстур
- "part: orm" - подключает функционал по работе с записями в бд
 
## Консольные команды
- Выполнение миграций в тестовой базе
```
php yii_test migrate
```
- Подготовка окружения для выполнения тестов
```
codecept build
```
- Запуск тестов
```
codecept run
```
- Запуск определенного теста. Команду надо запускать в директории где находится файл конфигурации  api.suite.yml
```
codecept run relative/peth/to/test/ProfileCest.php:ProfileCest
```
Запуск тестов с выводом более подробной информации
```
codecept run -vvv
```
- Создание нового теста
```
php codecept generate:cest suitename CestName
```
