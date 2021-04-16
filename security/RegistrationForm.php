<?php

namespace app\security;

use app\models\Institution;
use app\models\User;
use Yii;
use yii\base\Model;
use yii\helpers\Url;

/**
 * Форма регистрации
 */
class RegistrationForm extends Model
{

    /**
     * Пароль
     * @var string
     */
    public string $password = '';

    /**
     * Подтверждение пароля
     * @var string
     */
    public string $password_confirm = '';

    /**
     * Email
     * @var string
     */
    public string $email = '';

    /**
     * Фамилия
     * @var string
     */
    public string $surname = '';

    /**
     * Имя
     * @var string
     */
    public string $name = '';

    /**
     * @var string
     */
    public string $about = '';

    /**
     * Пользователь
     * @var User|null
     */
    private ?User $user = null;

    /**
     * @var int
     */
    public int $institution_id = 0;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['email', 'surname', 'name', 'password', 'password_confirm', 'institution_id'], 'required'],
            [['email', 'surname', 'name'], 'string', 'max' => 50],
            [['about'], 'string'],
            [['password'], 'string', 'min' => 6, 'max' => 50],
            [['password_confirm'], 'string'],
            [['password_confirm'], 'validatePasswordConfirm'],
            [['email'], 'email'],
            [['email'], 'filter', 'filter' => fn($email) => mb_strtolower(trim($email), 'UTF-8')],
            [['email'], 'unique', 'targetClass' => User::class, 'message' => 'Пользователь с таким email уже зарегистрирован!'],
            [['institution_id'], 'exist', 'skipOnError' => true, 'targetClass' => Institution::class, 'targetAttribute' => ['institution_id' => 'id']],
        ];
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function validatePasswordConfirm($attribute, $params)
    {
        if ($this->$attribute && $this->$attribute != $this->password) {
            $this->addError('password_confirm', 'Пароли не совпадают');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'password' => 'Пароль',
            'password_confirm' => 'Повторить пароль',
            'about' => 'О себе',
        ];
    }

    /**
     * @return bool
     */
    public function register(): bool
    {
        if ($this->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            $this->user = $this->createUser();
            if (!$this->user->hasErrors()) {
                $transaction->commit();
                return true;
            }
            $transaction->rollBack();
            $this->addErrors($this->user->getErrors());
        }
        return false;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @return User
     */
    private function createUser(): User
    {
        $user = new User();
        $user->email = $this->email;
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        $user->about = $this->about;
        $user->institution_id = $this->institution_id;
        $user->save();
        return $user;
    }

}
