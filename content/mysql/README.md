# Mysql
## Создание и разворачивание дампа данных

- Создание дампа базы данных
```
mysqldump -u user -p dbname --default-character-set=utf8 | gzip > dump.sql.gz
mysqldump -u user -p dbname --default-character-set=utf8 > dump.sql

```
- Создание дампа базы данных в Windows. Нельзя использовать ">"
```
mysqldump -u user -p dbname --result-file=dump.sql --default-character-set=utf8

```
- Создание дампа определенных таблиц
```
mysqldump -u user -p dbname table1 table2 --default-character-set=utf8  > dump.sql
```

- Разворот бекапа
```
mysql -u user -p DATABASE < dump.sql
gunzip < dump.sql.gz | mysql -u user -p dbname
```

### Рекомендации при проектировании базы данных
- Не использовать поля ENUM
- В таблицах связках всегда должно быть поле ID
- Для хранения даты и времени использовать целый тип данных и хранить в нем метку TIMESTAMP
- Избегайте использования NULL значения, задавайте дефолнтые значения для колонок

## Настройка MYSQL для логирования медленных запросов
```
 slow_query_log = 1
 long_query_time = 1
 log-queries-not-using-indexes = 0
 slow_query_log_file = <path_to_file>
 
```