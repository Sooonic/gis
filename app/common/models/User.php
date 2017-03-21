<?php


namespace common\models;


use yii\rbac\Role;

class User extends \gis\yii\user\User
{

    private $main_role;

    /**
     * @return \yii\rbac\Role[]
     */
    public function getRoles()
    {
        return \Yii::$app->authManager->getRolesByUser($this->id);
    }

    /**
     * @return null|\yii\rbac\Role
     */
    public function getMainRole()
    {
        return \Yii::$app->authManager->getRole($this->main_role);
    }

    /**
     * @param Role $role
     */
    public function setRole(Role $role)
    {
        $roles = \Yii::$app->authManager->getRoles();
        foreach ($roles as $assignedRole) {
            if ($role->name == $assignedRole->name) {
                return;
            }
        }
        \Yii::$app->authManager->assign($role, $this->id);
    }

    /**
     * @param Role $role
     */
    public function setMainRole(Role $role)
    {
        $this->setAttribute('main_role', $role->name);
        $this->setRole($role);
    }
}