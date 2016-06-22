<?php

namespace auth\models;

use Yii;
use yii\base\Model;
use auth\models\User;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
	public $email;
	public $password;
	public $rememberMe = true;
	public $verifyCode;

	private $_user = false;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// username and password are both required
			[['email', 'password'], 'required'],
			// password is validated by validatePassword()
			['password', 'validatePassword'],
			// rememberMe must be a boolean value
			['rememberMe', 'boolean'],
			['verifyCode', 'captcha', 'captchaAction' => 'auth/default/captcha', 'on' => 'withCaptcha'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'username' =>   'Username or Email' ,
			'password' =>   'Password',
			'rememberMe' =>   'Remember Me',
			'verifyCode' =>  'Verify Code',
		];
	}


	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 */
	public function validatePassword()
	{
		$user = $this->getUser();
		if (!$user || !$user->validatePassword($this->password)) {
			$this->addError('password',   'Incorrect username or password.') ;
		}
	}

	/**
	 * Logs in a user using the provided username and password.
	 *
	 * @return boolean whether the user is logged in successfully
	 */
	public function login()
	{
		if ($this->validate()) {
			return $this->getUser()->login($this->rememberMe ? Yii::$app->getModule('auth')->rememberMeTime : 0);
		} else {
			return false;
		}
	}

	/**
	 * Finds user by [[username]]
	 *
	 * @return User|null
	 */
	public function getUser()
	{
		if ($this->_user === false) {
			$this->_user = User::findByUsername($this->email);
		}
		return $this->_user;
	}

	public function getUserModel()
	{
			return  User::findByUsername($this->email);

	}


}
