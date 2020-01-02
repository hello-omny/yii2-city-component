<?php

use yii\db\Migration;

class m170516_204142_geo_load_data extends Migration
{
    private const FILES = [
        '_geo_continent.sql',
        '_geo_country.sql',
        '_geo_division.sql',
        '_geo_division2.sql',
        '_geo_city.sql',
    ];

    public function safeUp()
    {
        ini_set('memory_limit', '256M');
        foreach (self::FILES as $dataFile) {
            $file = file_get_contents(__DIR__ . $dataFile);
            $pattern = ";";
            $result = explode($pattern, $file);

            foreach ($result as $value) {
                if (!empty($value)) {
                    $this->execute($value . ";");
                }
            }

        }
    }

    public function safeDown()
    {

    }
}