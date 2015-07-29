<?php

use yii\db\Schema;
use yii\db\Migration;

class m150719_154955_add_setting_menu_links extends Migration
{

    public function up()
    {

        $this->insert('menu_link',
            ['id' => 'settings', 'menu_id' => 'admin-main-menu', 'label' => 'Settings',
            'image' => 'cog', 'order' => 20]);

        $this->insert('menu_link',
            ['id' => 'settings-general', 'menu_id' => 'admin-main-menu', 'link' => '/settings',
            'label' => 'Links', 'parent_id' => 'menu', 'order' => 2]);

    }

    public function down()
    {
        $this->delete('menu_link', ['like', 'id', 'settings-general']);
        $this->delete('menu_link', ['like', 'id', 'settings']);
    }
}