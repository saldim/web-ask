<p align="center">
    <h1 align="center">saldim/web-ask</h1>
    <br>
</p>

Web-приложение для анонимных вопросов на основе [Yii2](http://www.yiiframework.com/).

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

### Настройка администратора
В файле `models\User.php` отредактируйте массив `$users` в соответствии с вашими потребностями. 
Например:
```php
    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'verysecretkey',
            'accessToken' => 'verysecrettoken',
        ],
    ];
```

### Инициализация

Для формирования структуры базы данных примените миграции выполнив команду `php yii migrate` в директории с проектом.


### Настройка веб-сервера

В качестве корневой директории для веб-сервера необходимо указать папку `/web`

Пример конфигурацпии для Apache2:
```
<VirtualHost *:80>
        ServerName ask.saldim.ru
        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/ask/web
        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
        <Directory "/var/www/ask/web">
            Options Indexes FollowSymLinks
            AllowOverride all
            Require all granted
        </Directory>
    </VirtualHost>
```