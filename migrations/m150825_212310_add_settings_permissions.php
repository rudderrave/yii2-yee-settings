<?php

use yii\db\Migration;
use yii\db\Schema;

class m150825_212310_add_settings_permissions extends Migration
{

    public function up()
    {

        $this->insert('auth_item_group', ['code' => 'settings', 'name' => 'Settings', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item', ['name' => '/admin/settings/*', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/settings/default/*', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/settings/default/index', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/settings/reading/index', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/settings/cache/flush', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item', ['name' => 'changeGeneralSettings', 'type' => '2', 'description' => 'Change general settings', 'group_code' => 'settings', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'changeReadingSettings', 'type' => '2', 'description' => 'Change reading settings', 'group_code' => 'settings', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'flushCache', 'type' => '2', 'description' => 'Flush Cache', 'group_code' => 'settings', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item_child', ['parent' => 'changeGeneralSettings', 'child' => '/admin/settings/default/index']);
        $this->insert('auth_item_child', ['parent' => 'changeReadingSettings', 'child' => '/admin/settings/reading/index']);
        $this->insert('auth_item_child', ['parent' => 'flushCache', 'child' => '/admin/settings/cache/flush']);

        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'changeGeneralSettings']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'changeReadingSettings']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'flushCache']);
    }

    public function down()
    {
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'changeReadingSettings']);
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'changeGeneralSettings']);
        $this->delete('auth_item_child', ['parent' => 'changeGeneralSettings', 'child' => '/admin/settings/default/index']);

        $this->delete('auth_item', ['name' => 'changeGeneralSettings']);
        $this->delete('auth_item', ['name' => 'changeReadingSettings']);

        $this->delete('auth_item', ['name' => '/admin/settings/*']);
        $this->delete('auth_item', ['name' => '/admin/settings/default/*']);
        $this->delete('auth_item', ['name' => '/admin/settings/default/index']);
        $this->delete('auth_item', ['name' => '/admin/settings/reading/index']);

        $this->delete('auth_item_group', ['code' => 'settings']);
    }
}