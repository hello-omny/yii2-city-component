<?php

use yii\db\Migration;

class m170516_204141_geo_extend_structure extends Migration
{
    public function safeUp()
    {
        $this->createTable('geo_continent', [
            'id' => $this->primaryKey()->unsigned(),
            'fgi_id' => $this->integer()->unsigned(),
            'code' => $this->string(3)->notNull(),
            'name' => $this->string(20)->notNull(),
            'name_ru' => $this->string(50)->notNull(),
        ]);
        $this->createIndex('idx__continent__fgi_id', 'geo_continent', 'fgi_id');
        $this->createIndex('idx__continent__code', 'geo_continent', 'code');
        $this->createIndex('idx__continent__name', 'geo_continent', 'name');


        $this->createTable('geo_country', [
            'id' => $this->primaryKey()->unsigned(),
            'fgi_id' => $this->integer()->unsigned(),
            'code' => $this->string(3)->notNull(),
            'name' => $this->string(70)->notNull(),
            'name_ru' => $this->string(100)->notNull(),
            'continent_id' => $this->integer()->unsigned()->notNull(),
        ]);
        $this->createIndex('idx__country__fgi_id', 'geo_country', 'fgi_id');
        $this->createIndex('idx__country__code', 'geo_country', 'code');
        $this->createIndex('idx__country__name', 'geo_country', 'name');
        $this->addForeignKey('fk__country_continent', 'geo_country', 'continent_id', 'geo_continent', 'id');


        $this->createTable('geo_division', [
            'id' => $this->primaryKey()->unsigned(),
            'fgi_id' => $this->integer()->unsigned(),
            'code' => $this->string(3)->notNull(),
            'name' => $this->string(100)->notNull(),
            'name_ru' => $this->string(150)->notNull(),
            'country_id' => $this->integer()->unsigned()->notNull(),
        ]);
        $this->createIndex('idx__division__fgi_id', 'geo_division', 'fgi_id');
        $this->createIndex('idx__division__code', 'geo_division', 'code');
        $this->createIndex('idx__division__name', 'geo_division', 'name');
        $this->addForeignKey('fk__division_country', 'geo_division', 'country_id', 'geo_country', 'id');


        $this->createTable('geo_division2', [
            'id' => $this->primaryKey()->unsigned(),
            'fgi_id' => $this->integer()->unsigned(),
            'code' => $this->string(3)->notNull(),
            'name' => $this->string(100)->notNull(),
            'name_ru' => $this->string(150)->notNull(),
            'division_id' => $this->integer()->unsigned()->notNull(),
            'country_id' => $this->integer()->unsigned()->notNull(),
        ]);
        $this->createIndex('idx__division2__fgi_id', 'geo_division2', 'fgi_id');
        $this->createIndex('idx__division2__code', 'geo_division2', 'code');
        $this->createIndex('idx__division2__name', 'geo_division2', 'name');
        $this->addForeignKey('fk__division2_country', 'geo_division2', 'country_id', 'geo_country', 'id');
        $this->addForeignKey('fk__division2_division', 'geo_division2', 'division_id', 'geo_division', 'id');


        $this->createTable('geo_city', [
            'id' => $this->bigPrimaryKey()->unsigned(),
            'slug' => $this->string(100)->notNull(),
            'fgi_id' => $this->integer()->unsigned(),
            'name' => $this->string(70)->notNull(),
            'name_ru' => $this->string(100)->notNull(),
            'division_id' => $this->integer()->unsigned()->notNull(),
            'division2_id' => $this->integer()->unsigned()->null()->defaultValue(null),
            'country_id' => $this->integer()->unsigned()->notNull(),
        ]);
        $this->createIndex('idx__city__slug', 'geo_city', 'slug');
        $this->createIndex('idx__city__fgi_id', 'geo_city', 'fgi_id');
        $this->createIndex('idx__city__name', 'geo_city', 'name');
        $this->addForeignKey('fk__city_country', 'geo_city', 'country_id', 'geo_country', 'id');
        $this->addForeignKey('fk__division_division', 'geo_city', 'division_id', 'geo_division', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk__city_country', 'geo_city');
        $this->dropForeignKey('fk__division_division', 'geo_city');
        $this->dropForeignKey('fk__division2_country', 'geo_division2');
        $this->dropForeignKey('fk__division2_division', 'geo_division2');
        $this->dropForeignKey('fk__country_continent', 'geo_country');
        $this->dropForeignKey('fk__division_country', 'geo_division');

        $this->dropTable('geo_continent');
        $this->dropTable('geo_country');
        $this->dropTable('geo_division');
        $this->dropTable('geo_division2');
        $this->dropTable('geo_city');
    }
}
