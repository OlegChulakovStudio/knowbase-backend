# Подключение PHPUnit к проекту

## Установка через композер
```$bash
composer require phpunit/phpunit
```
## Добавление конфигурации phpunit.xml
Пример:

```$xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit bootstrap="bootstrap/autoload.php">
    <testsuites>
        <testsuite name="unit">
            <directory suffix="Test.php">./tests/unit</directory>
        </testsuite>
    </testsuites>
</phpunit>
```
## Добавление конфигурации phpunit в настройках проекта
- Перейдите в настройки проекта, в поиске наберите "PHPUnit" и добавьте конфигрурацию PHPUnit Local.
![Перейдите в настройки и добавьте конфигурацию... ](/content/phpstorm/phpunit/img/1.png)
- Укажите пути к autoload.php и файлу конфигурации phpunit.xml.
![Указание параметров... ](/content/phpstorm/phpunit/img/2.png)

[Читать далее](/content/phpstorm/phpunit/part2/README.md)