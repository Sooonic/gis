<?php


namespace api\forms\site;


use api\models\User;
use yii\base\Exception;
use yii\base\Model;
use Yii;

class LoginForm extends Model
{

    const SCENARIO_LOGIN_BY_EMAIL = 1;
    const SCENARIO_LOGIN_BY_USERNAME = 2;

    /**
     * @var User
     */
    private $_user;

    public $password;
    public $email;
    public $username;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['username', 'required', 'on' => self::SCENARIO_LOGIN_BY_USERNAME],
            ['email', 'required', 'on' => self::SCENARIO_LOGIN_BY_EMAIL],
            ['username', 'string'],
            ['email', 'email'],
            ['password', 'string', 'min' => User::MIN_LENGTH_PASSWORD],
        ];
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), /*$this->rememberMe ? 3600 * 24 * 30 : */0);
        }
        return false;
    }

    public function validate($attributeNames = null, $clearErrors = true)
    {
        if(!parent::validate($attributeNames, $clearErrors)){
            return false;
        }

        if($this->getUser() === null){
            $this->addError('user', 'User does not exists');
            return false;
        }

        if(!$this->getUser()->validatePassword($this->password)){
            $this->addError('password', 'Password incorrect');
            return false;
        }

        return true;
    }

    public function beforeValidate()
    {
        if($this->getScenario() === self::SCENARIO_DEFAULT){
            if(!empty($this->username)){
                $this->setScenario(self::SCENARIO_LOGIN_BY_USERNAME);
            }
            else if(!empty($this->email)){
                $this->setScenario(self::SCENARIO_LOGIN_BY_EMAIL);
            }
        }
        return parent::beforeValidate();
    }

    /**
     * @return User
     * @throws Exception
     */
    public function getUser() : ?User
    {
        if($this->_user === null) {
            switch ($this->getScenario()) {
                case self::SCENARIO_LOGIN_BY_EMAIL:
                    $this->_user = User::findByEmail($this->email);
                    break;
                case self::SCENARIO_LOGIN_BY_USERNAME:
                default:
                    $this->_user = User::findByUsername($this->username);
            }
        }
        return $this->_user;
    }
}