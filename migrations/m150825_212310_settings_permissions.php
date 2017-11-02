<?php

use yeesoft\db\PermissionsMigration;

class m150825_212310_settings_permissions extends PermissionsMigration
{

    public function safeUp()
    {
        $this->addPermissionsGroup('settings-management', 'Settings Management');

        parent::safeUp();
    }

    public function safeDown()
    {
        parent::safeDown();
        $this->deletePermissionsGroup('settings-management');
    }

    public function getPermissions()
    {
        return [
            'settings-management' => [
                'update-general-settings' => [
                    'title' => 'Update General Settings',
                    'roles' => [self::ROLE_ADMIN],
                    'routes' => [
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'settings/default', 'action' => 'index'],
                    ],
                ],
                'update-reading-settings' => [
                    'title' => 'Update Reading Settings',
                    'roles' => [self::ROLE_ADMIN],
                    'routes' => [
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'settings/reading', 'action' => 'index'],
                    ],
                ],
                'flush-cache' => [
                    'title' => 'Flush Cache',
                    'roles' => [self::ROLE_ADMIN],
                    'routes' => [
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'settings/cache', 'action' => 'flush'],
                    ],
                ],
            ],
        ];
    }

}
