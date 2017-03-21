<?php


namespace gis\yii\rbac;


use yii\rbac\Rule;

class UserGroupRule extends Rule
{

    public $name = 'usergroup';


    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        $userRoles = \Yii::$app->authManager->getRolesByUser($user);
        foreach ($userRoles as $userRole) {
            if ($item->name == $userRole->name) {
                return true;
            }
        }
        return false;
    }
}