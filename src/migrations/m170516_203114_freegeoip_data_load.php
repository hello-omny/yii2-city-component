<?php

use yii\db\Migration;

class m170516_203114_freegeoip_data_load extends Migration
{
    public function up()
    {
        ini_set('memory_limit', '256M');
        $file = file_get_contents(__DIR__ . "/data_freegeoip_02-04-2017.sql");
        $pattern = ";";
        $result = explode($pattern, $file);

        foreach ($result as $value) {
            if (!empty($value)) {
                $this->execute($value . ";");
            }
        }
    }

    public function down()
    {
        $this->truncateTable('freegeoip');
    }
}
