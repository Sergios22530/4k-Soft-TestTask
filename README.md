# ТЗ
[тз](web/files/new.test-back.pdf)

Обязательно
-----
```
После развертывания проекта на Yii2 (смотри ниже - YII2 INSTALLATION) обязательно нужно запустить миграцию бази - php yii/migrate/up. 
С миграцией будет создана root ячейка (Для корректной работы ее желательно не удалять). 
```

Построения бинара
------------
```php
use app\components\TreeCreator;

/** @return bool */
(new TreeCreator(1, 1))->createNode(); //создание бинара; 
//1 параметр в кострукторе - идентификатор родителя; 
//2 параметр в кострукторе - позиция ячейки относительно родителя  
```
Получение по id ячейки все вышестоящие и нижестоящие ячейки
------------
```php
use app\components\TreeControl;

$treeControl = new TreeControl();

/** @return  array|string|null */
$treeControl->getChildNodes(2); //Получение по id ячейки все нижестоящие ячейки; Возвращает массив; 

/** @return  array|string|null */
$treeControl->getParentNodes(10); //Получение по id ячейки все вышестоящие ячейки; Возвращает массив; 

```
Автоматически заполнить бинар до 5 уровня, включительно, слева направо, сверху вниз
------------
```php
use app\components\TreeControl;

/** @return  array|string|null */
(new TreeControl())->autoCompleteTree(); //Возвращает массив заполненного дерева;
```

YII2 INSTALLATION
------------

~~~
1. git clone https://github.com/Sergios22530/UkrTech-TestTask.git .
2. composer install
3. Заходим в config/db.php - меняем конфигурацию базы данных на свою 
4. php yii migrate/up - запускаем миграцию базы
~~~


### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
php composer.phar global require "fxp/composer-asset-plugin:~1.0.0"
php composer.phar create-project --prefer-dist --stability=dev yiisoft/yii2-app-basic basic
~~~

Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

~~~
http://localhost/basic/web/
~~~


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTE:** Yii won't create the database for you, this has to be done manually before you can access it.

Also check and edit the other files in the `config/` directory to customize your application.
