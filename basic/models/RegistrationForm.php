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
    public $fio;
    public $password;
    public $confirm;
    public $email;
    public $phone;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['fio', 'password', 'confirm', 'email', 'phone'], 'required'],
            [['password'], 'string', 'min' => 8],
            ['email', 'email'],
            ['password', 'validatePassword'],
            ['fio', 'validateFio'],
            ['email', 'validateEmail'],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fio' => 'ФИО',
            'password' => 'Пароль',
            'confirm' => 'Повторите пароль',
            'email' => 'E-mail',
            'phone' => 'Номер телефона',
            'verifyCode' => 'Проверка',
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
                $this->addError($attribute, 'Пароли не совпадают.');
            }
            if (!$this->isStrongPassword($this->password)) {
                $this->addError($attribute, 'Слишком легкий пароль. (Пароль должен содержать как минимум одну цифру и одну заглавную букву)');
            }
        }
    }

    public function validateFio($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $_user = User::findByUsername($this->fio);
            if ($_user !== null) {
                $this->addError($attribute, 'Такой пользователь уже существует.');
            }
        }
    }

    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $_user = User::findOne(['email' => $this->email]);
            if ($_user !== null) {
                $this->addError($attribute, 'Этот e-mail уже занят.');
            }
        }
    }

    /**
     * Register user using the provided username and password.
     * @return true whether the user is registered successfully
     * @throws Exception
     */
    public function register()
    {
        if ($this->validate()) {
            $user = new User();

            $user->fio = $this->fio;
            $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $user->email = $this->email;
            $user->phone = $this->phone;
            $user->token = Yii::$app->security->generateRandomString();

            if ($user->save(false)) {
                $this->sendEmail($user);
                Yii::$app->session->setFlash('success', 'Подтвердите ваш e-mail.');
            }
        }

        return true;
    }

    /** @var $user User */
    public function sendEmail($user)
    {
        Yii::$app->mailer
            ->compose(
                ['html' => 'confirm-html'],
                ['user' => $user])
            ->setTo($user->email)
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setSubject('Confirmation of registration')
            ->send();
    }

    public static function confirm($token)
    {
        $user = User::findOne(['token' => $token]);
        $user->updateAttributes(['token' => null, 'status' => User::STATUS_ACTIVE]);
    }

    private function isStrongPassword($password): bool
    {
        if (preg_match('/\d/', $password) === 0) {
            return false;
        }
        if (preg_match('/[A-Z]/', $password) === 0) {
            return false;
        }

        return true;
    }
}
