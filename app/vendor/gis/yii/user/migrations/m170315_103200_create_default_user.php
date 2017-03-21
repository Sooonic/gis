<?php
namespace gis\yii\user\migrations;

use yii\db\Migration;

class m170315_103200_create_default_user extends Migration
{
    public function up()
    {
        $model = new \common\models\User();
        $model->id = 1;
        $model->username = 'superadmin';
        $model->password = '';
        $model->auth_key = '';
        $model->password_hash = '';
        $model->password_reset_token = '';
        $model->email = '';
        $model->setMainRole(Yii::$app->authManager->getRole('superadmin'));
        $model->save();
    }

    public function down()
    {
        $model = \common\models\User::findOne(1);
        if ($model !== null) {
            $model->delete();
        }
    }
}
