<?php

use yii\db\Migration;

class m160419_144710_i18n_ru_menu_setting extends Migration
{

    public function up()
    {
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'settings', 'label' => 'Настройки', 'language' => 'ru']);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'settings-general', 'label' => 'Общие Настройки', 'language' => 'ru']);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'settings-reading', 'label' => 'Настройки Чтения', 'language' => 'ru']);
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'settings-cache', 'label' => 'Очистить Кэш', 'language' => 'ru']);
    }

}