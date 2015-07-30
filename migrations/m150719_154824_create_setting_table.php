<?php

use yii\db\Migration;
use yii\db\Schema;

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
                'group' => Schema::TYPE_STRING . '(64) COLLATE utf8_unicode_ci DEFAULT "general"',
                'key' => Schema::TYPE_STRING . '(64) COLLATE utf8_unicode_ci NOT NULL',
                'value' => Schema::TYPE_TEXT . ' COLLATE utf8_unicode_ci NOT NULL',
                'description' => Schema::TYPE_TEXT . ' COLLATE utf8_unicode_ci DEFAULT NULL',
            ], $tableOptions);

        $this->addPrimaryKey('pk', 'menu', ['group', 'key']);
        $this->createIndex('setting_group', 'setting', 'group');
    }

    public function down()
    {
        $this->dropTable('setting');
    }
}