<?php

use yii\db\Migration;

class m170516_201443_freegeoip_structure_init extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('freegeoip', [
            'id' => $this->primaryKey(),
            'continent_code' => $this->string(4),
            'continent_name' => $this->string(),
            'continent_name_en' => $this->string(),
            'country_iso_code' => $this->string(4),
            'country_name' => $this->string(),
            'country_name_en' => $this->string(),
            'subdivision_1_iso_code' => $this->string(4),
            'subdivision_1_name' => $this->string(),
            'subdivision_1_name_en' => $this->string(),
            'subdivision_2_iso_code' => $this->string(4),
            'subdivision_2_name' => $this->string(),
            'subdivision_2_name_en' => $this->string(),
            'city_name' => $this->string(),
            'city_name_en' => $this->string(),
            'metro_code' => $this->string(),
            'time_zone' => $this->string(),
        ], $tableOptions);

        $this->createIndex('idx-freegeoip-country_iso_code', 'freegeoip', 'country_iso_code');
        $this->createIndex('idx-freegeoip-subdivision_1_iso_code', 'freegeoip', 'subdivision_1_iso_code');
        $this->createIndex('idx-freegeoip-subdivision_2_iso_code', 'freegeoip', 'subdivision_2_iso_code');
    }

    public function down()
    {
        $this->dropTable('freegeoip');
    }
}
