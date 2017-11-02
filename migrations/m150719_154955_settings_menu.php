<?php

use yii\db\Migration;

class m150719_154955_settings_menu extends Migration
{

    public function up()
    {
        $this->insert('{{%menu_link}}', ['id' => 'admin-menu-settings', 'menu_id' => 'admin-menu', 'image' => 'cog', 'created_by' => 1, 'order' => 20]);
        $this->insert('{{%menu_link}}', ['id' => 'admin-menu-settings-general', 'menu_id' => 'admin-menu', 'link' => '/settings/default/index', 'parent_id' => 'admin-menu-settings', 'created_by' => 1, 'order' => 1]);
        $this->insert('{{%menu_link}}', ['id' => 'admin-menu-settings-reading', 'menu_id' => 'admin-menu', 'link' => '/settings/reading/index', 'parent_id' => 'admin-menu-settings', 'created_by' => 1, 'order' => 2]);
        $this->insert('{{%menu_link}}', ['id' => 'admin-menu-settings-cache', 'menu_id' => 'admin-menu', 'link' => '/settings/cache/flush', 'parent_id' => 'admin-menu-settings', 'created_by' => 1, 'order' => 99]);

        $this->insert('{{%menu_link_lang}}', ['link_id' => 'admin-menu-settings', 'label' => 'Settings', 'language' => 'en-US']);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'admin-menu-settings-general', 'label' => 'General Settings', 'language' => 'en-US']);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'admin-menu-settings-reading', 'label' => 'Reading Settings', 'language' => 'en-US']);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'admin-menu-settings-cache', 'label' => 'Flush Cache', 'language' => 'en-US']);
    }

    public function down()
    {
        $this->delete('{{%menu_link}}', ['like', 'id', 'admin-menu-settings-cache']);
        $this->delete('{{%menu_link}}', ['like', 'id', 'admin-menu-settings-reading']);
        $this->delete('{{%menu_link}}', ['like', 'id', 'admin-menu-settings-general']);
        $this->delete('{{%menu_link}}', ['like', 'id', 'admin-menu-settings']);
    }

}
