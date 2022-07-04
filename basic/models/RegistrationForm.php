<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class RegistrationForm extends Model
{
    public $username;
    public $password;
    public $confirm;
    public $email;
    public $profile = '';
    private $salt;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password', 'confirm', 'email'], 'required'],
            [['password'], 'string', 'min' => 8],
            ['email', 'email'],
            ['password', 'validatePassword'],
            ['username', 'validateUsername'],
            ['email', 'validateEmail']
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->password !== $this->confirm) {
                $this->addError($attribute, 'Passwords doesn\'t match.');
            }
            if (!$this->isStrongPassword($this->password)) {
                $this->addError($attribute, 'Password is too weak. (Password must contains at least one digit and one uppercase letter)');
            }
        }
    }

    public function validateUsername($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $_user = User::findByUsername($this->username);
            if ($_user !== null) {
                $this->addError($attribute, 'This username is already taken.');
            }
        }
    }

    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $_user = User::findOne(['email' => $this->email]);
            if ($_user !== null) {
                $this->addError($attribute, 'This e-mail is already taken.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     * @throws Exception
     */
    public function register()
    {
        if ($this->validate()) {
            $user = new User();

            $user->username = $this->username;
            $user->salt = $this->salt = $this->generateRandomString();
            $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password . $this->salt);
            $user->email = $this->email;
            $user->profile = $this->profile;

            if ($user->save()) {
                return Yii::$app->user->login($user);
            }
        }

        return false;
    }

    function generateRandomString($length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function isStrongPassword($password)
    {
        if (preg_match('/[\d]/', $password) === 0) {
            return false;
        }
        if (preg_match('/[A-Z]/', $password) === 0) {
            return false;
        }

        return true;
    }
}
