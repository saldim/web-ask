<p align="center">
    <h1 align="center">saldim/ask-web</h1>
    <br>
</p>

Web-приложение для анонимных вопросов на основе [Yii 2](http://www.yiiframework.com/).



Требования
------------

Минимальная версия PHP 5.4.0


Конфигурация
-------------

### База данных

Отредактируйте `config/db.php` в соответствии с вашими настройками, например:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=ask_saldim',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
