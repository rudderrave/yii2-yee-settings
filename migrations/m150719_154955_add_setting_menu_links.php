<?php

use yii\db\Migration;
use yii\db\Schema;

class m150719_154955_add_setting_menu_links extends Migration
{

    public function up()
    {
        $this->insert('menu_link', ['id' => 'settings', 'menu_id' => 'admin-main-menu', 'image' => 'cog', 'order' => 20]);
        $this->insert('menu_link', ['id' => 'settings-general', 'menu_id' => 'admin-main-menu', 'link' => '/settings/default/index', 'parent_id' => 'settings', 'order' => 1]);
        $this->insert('menu_link', ['id' => 'settings-reading', 'menu_id' => 'admin-main-menu', 'link' => '/settings/reading/index', 'parent_id' => 'settings', 'order' => 2]);
        $this->insert('menu_link', ['id' => 'settings-cache', 'menu_id' => 'admin-main-menu', 'link' => '/settings/cache/flush', 'parent_id' => 'settings', 'order' => 99]);

        $this->insert('menu_link_lang', ['link_id' => 'settings', 'label' => 'Settings', 'language' => 'en' ]);
        $this->insert('menu_link_lang', ['link_id' => 'settings-general', 'label' => 'General Settings', 'language' => 'en' ]);
        $this->insert('menu_link_lang', ['link_id' => 'settings-reading', 'label' => 'Reading Settings', 'language' => 'en' ]);
        $this->insert('menu_link_lang', ['link_id' => 'settings-cache', 'label' => 'Flush Cache', 'language' => 'en' ]);
    }

    public function down()
    {
        $this->delete('menu_link', ['like', 'id', 'settings-cache']);
        $this->delete('menu_link', ['like', 'id', 'settings-general']);
        $this->delete('menu_link', ['like', 'id', 'settings']);
    }
}