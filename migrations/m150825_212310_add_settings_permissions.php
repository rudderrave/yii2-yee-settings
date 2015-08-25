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

        $this->insert('auth_item', ['name' => 'changeGeneralSettings', 'type' => '2', 'description' => 'Change general settings', 'group_code' => 'settings', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item_child', ['parent' => 'changeGeneralSettings', 'child' => '/admin/settings/default/index']);

        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'changeGeneralSettings']);
    }

    public function down()
    {
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'changeGeneralSettings']);
        $this->delete('auth_item_child', ['parent' => 'changeGeneralSettings', 'child' => '/admin/settings/default/index']);

        $this->delete('auth_item', ['name' => 'changeGeneralSettings']);

        $this->delete('auth_item', ['name' => '/admin/settings/*']);
        $this->delete('auth_item', ['name' => '/admin/settings/default/*']);
        $this->delete('auth_item', ['name' => '/admin/settings/default/index']);

        $this->delete('auth_item_group', ['code' => 'settings']);
    }
}