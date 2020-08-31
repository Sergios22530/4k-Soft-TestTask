Настройка отправки почти
------------
/config/params.php 
```php

return [
    'support' => [
        'email' => 'example@gmail.com', // Почта отправителя - gmail smtp
        'password' => 'examplePassword' // Пароль от почты отправителя
    ],
    'adminEmail' => 'example-receiver@gmail.com' // Почта получателя - gmail smtp
];

```
**Важно:** Если отправка почты не работает тогда нужно в аккаунте почты отправители разрешить доступ к небезопасным устройствам и очистить гугловских рекапчу https://accounts.google.com/DisplayUnlockCaptcha

Установка YII2
------------
~~~
1. git clone https://github.com/Sergios22530/4k-Soft-TestTask.git .
2. composer install
3. Заходим в config/db.php - меняем конфигурацию базы данных на свою 
4. php yii migrate/up - запускаем миграцию базы
~~~