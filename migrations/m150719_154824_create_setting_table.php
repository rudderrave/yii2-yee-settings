<?php

use yii\db\Schema;
use yii\db\Migration;

class m150719_154824_create_setting_table extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('setting',
            [
            'id' => Schema::TYPE_STRING.'(64) COLLATE utf8_unicode_ci NOT NULL',
            'group' => Schema::TYPE_STRING.'(64) COLLATE utf8_unicode_ci DEFAULT "general"',
            'value' => Schema::TYPE_TEXT.' COLLATE utf8_unicode_ci NOT NULL',
            ], $tableOptions);

        $this->addPrimaryKey('pk', 'menu', 'id');
		$this->createIndex('setting_group', 'setting', 'group');
    }

    public function down()
    {
        $this->dropTable('setting');
    }
}