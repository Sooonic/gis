<?php
namespace gis\yii\rbac\migrations;

use Yii;
use yii\db\Migration;

class m170314_124106_base_user_roles extends Migration
{
    public function up()
    {
        $authManager = Yii::$app->authManager;

        $userGroupRule = new \gis\yii\rbac\UserGroupRule();
        $authManager->add($userGroupRule);
        $superAdmin = $authManager->createRole('superadmin');
        $superAdmin->ruleName = $userGroupRule->name;
        $authManager->add($superAdmin);
    }

    public function down()
    {
        $authManager = Yii::$app->authManager;
        $authManager->removeAll();
    }
}
