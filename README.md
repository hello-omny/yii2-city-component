Yii2 geo component
===================
Yii2 geo component extension

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist omny/yii2-geo-component "*"
```

or add

```
"omny/yii2-geo-component": "*"
```

for actual code and fixes:

```
"omny/yii2-geo-component": "dev-master"
```

to the require section of your `composer.json` file.

Update database schema
----------------------

The last thing you need to do is updating your database schema by applying the migrations. Make sure that you have properly configured db application component and run the following command:

```
$ php yii migrate/up --migrationPath=@vendor/omny/yii2-geo-component/src/migrations
```
