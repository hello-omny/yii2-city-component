Yii2 city component
===================
Yii2 city component extension

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist omny/yii2-city-component "*"
```

or add

```
"omny/yii2-city-component": "*"
```

for actual code and fixes:

```
"omny/yii2-city-component": "dev-master"
```

to the require section of your `composer.json` file.

Update database schema
----------------------

The last thing you need to do is updating your database schema by applying the migrations. Make sure that you have properly configured db application component and run the following command:

```
$ php yii migrate/up --migrationPath=@vendor/omny/yii2-city-component/src/migrations
```

Usage
-----

Once the extension is installed, simply use it in your code by:

```php
$cityComponent = Yii:$app->city;
```

Get model

```
// Get FreegeoIp model
$freeGeoIpCityModel = $cityComponent->getCity();
$freeGeoIpRegionModel = $cityComponent->getRegion();
```

Get model properties

```
// Get city name
$freeGeoIpCityModel->city_name
```

Available properties see in `src/entity/FreegeoipEntity.php`.

```
integer $id
string $continent_code
string $continent_name
string $continent_name_en
string $country_iso_code
string $country_name
string $country_name_en
string $subdivision_1_iso_code
string $subdivision_1_name
string $subdivision_1_name_en
string $subdivision_2_iso_code
string $subdivision_2_name
string $subdivision_2_name_en
string $city_name
string $city_name_en
string $metro_code
string $time_zone
```

Set city or region in your code

```
// Set city or region by id (from geoip)
$id = 472045 // Voronezh, Russia
$cityComponent->setCity($id);
$cityComponent->setRegion($id);
```
