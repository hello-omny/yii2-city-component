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

    /**
     *
     */
    private function loadByline()
    {
        $requestHeader = "INSERT INTO `freegeoip` (`id`, `continent_code`, `continent_name`, `continent_name_en`, `country_iso_code`, `country_name`, `country_name_en`, `subdivision_1_iso_code`, `subdivision_1_name`, `subdivision_1_name_en`, `subdivision_2_iso_code`, `subdivision_2_name`, `subdivision_2_name_en`, `city_name`, `city_name_en`, `metro_code`, `time_zone`) VALUES";
        $handle = fopen(__DIR__ . "/data_freegeoip_02-04-2017.sql", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);
                $line = substr($line, 0, -1);
                $this->execute($requestHeader . " " . substr($line, 0, strlen($line)));
            }
            fclose($handle);
        } else {
            echo "Cant read file.";
        }
    }
}
