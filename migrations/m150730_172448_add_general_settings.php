<?php

use yii\db\Migration;
use yii\db\Schema;

class m150730_172448_add_general_settings extends Migration
{

    public function up()
    {

        $this->insert('setting',
            ['group' => 'general', 'key' => 'title', 'value' => 'Yee Site']);

        $this->insert('setting',
            ['group' => 'general', 'key' => 'description', 'value' => '']);

        $this->insert('setting',
            ['group' => 'general', 'key' => 'email', 'value' => '', 'description' => 'This address is used for admin purposes, like new user notification.']);

        $this->insert('setting',
            ['group' => 'general', 'key' => 'dateformat', 'value' => 'F j, Y']);

        $this->insert('setting',
            ['group' => 'general', 'key' => 'timeformat', 'value' => 'g:i a']);

        $this->insert('setting',
            ['group' => 'general', 'key' => 'timezone', 'value' => 'Europe/London']);
    }

    public function down()
    {
        $this->delete('setting', ['group' => 'group', 'key' => 'title']);
        $this->delete('setting', ['group' => 'group', 'key' => 'description']);
        $this->delete('setting', ['group' => 'group', 'key' => 'email']);
        $this->delete('setting', ['group' => 'group', 'key' => 'dateformat']);
        $this->delete('setting', ['group' => 'group', 'key' => 'timeformat']);
        $this->delete('setting', ['group' => 'group', 'key' => 'timezone']);
    }
}