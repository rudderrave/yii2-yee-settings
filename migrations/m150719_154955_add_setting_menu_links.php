<?php

use yii\db\Migration;
use yii\db\Schema;

class m150719_154955_add_setting_menu_links extends Migration
{

    public function up()
    {

        $this->insert('menu_link',
            ['id' => 'settings', 'menu_id' => 'admin-main-menu', 'label' => 'Settings',
                'image' => 'cog', 'order' => 20]);

        $this->insert('menu_link',
            ['id' => 'settings-general', 'menu_id' => 'admin-main-menu', 'link' => '/settings',
                'label' => 'General Settings', 'parent_id' => 'settings', 'order' => 1]);

    }

    public function down()
    {
        $this->delete('menu_link', ['like', 'id', 'settings-general']);
        $this->delete('menu_link', ['like', 'id', 'settings']);
    }
}