<?php

use yii\db\Migration;

class m151122_144710_i18n_uk_menu_setting extends Migration
{

    public function up()
    {
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'settings', 'label' => 'Налаштування', 'language' => 'uk']);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'settings-general', 'label' => 'Загальні Налаштування', 'language' => 'uk']);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'settings-reading', 'label' => 'Налаштування Читання', 'language' => 'uk']);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'settings-cache', 'label' => 'Очистити Кеш', 'language' => 'uk']);
    }

}