REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 7.4.


INSTALLATION
------------

### 1. Download project

~~~
git clone https://github.com/janis-j/CvOnline.git
~~~

### 2. Install Composer Dependencies

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

~~~
composer install
~~~

### 3. Create local database and edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
### 4. Run command to migrate necessary tables to database

~~~
php yii migrate
~~~

### 4. Run your local server and start using application