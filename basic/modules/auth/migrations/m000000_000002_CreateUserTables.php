<?php
use yii\db\Schema;

class m000000_000002_CreateUserTables extends \yii\db\Migration
{
	private $tableMap;

	public function safeUp()
	{
		$tableMap = Yii::$app->getModule('auth')->tableMap;

		$this->createTable(
			 $tableMap['User'],
				 array(
					 'id' => Schema::TYPE_PK,
					 'username' => Schema::TYPE_STRING . '(64) NOT NULL',
					 'email' => Schema::TYPE_STRING . '(128) NOT NULL',
					 'password_hash' => Schema::TYPE_STRING . '(128) NOT NULL',
					 'password_reset_token' => Schema::TYPE_STRING . '(32)',
					 'auth_key' => Schema::TYPE_STRING . '(128)',
					 'status' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT ' . auth\models\User::STATUS_ACTIVE,
					 'last_visit_time' => $this->dateTime(),
					 'create_time' => $this->dateTime()->notNull(),
					 'update_time' => $this->dateTime(),
					 'delete_time' => $this->dateTime(),
				 )
		);
		$this->createIndex('User_status_ix', $tableMap['User'], 'status');



		// Creates the default admin user
		$adminUser = new \auth\models\User();

		echo 'Please type the admin user info: ' . PHP_EOL;
		$this->readStdinUser('Email (e.g. admin@mydomain.com)', $adminUser, 'email');
		$this->readStdinUser('Type Username', $adminUser, 'username', $adminUser->email);
		$this->readStdinUser('Type Password', $adminUser, 'password', 'admin');


		if (!$adminUser->save()) {
			throw new \yii\console\Exception('Error when creating admin user.');
		}

		$adminUser->status = 89;

		$adminUser->save();
		var_dump($adminUser);
		echo 'User created successfully.' . PHP_EOL;
	}

	private function readStdinUser($prompt, $model, $field, $default = '')
	{
		while (!isset($input) || !$model->validate(array($field))) {
			echo $prompt . (($default) ? " [$default]" : '') . ': ';
			$input = (trim(fgets(STDIN)));
			if (empty($input) && !empty($default)) {
				$input = $default;
			}
			$model->$field = $input;
		}
		return $input;
	}

	public function safeDown()
	{
		$tableMap = Yii::$app->getModule('auth')->tableMap;
		$this->dropTable($tableMap['User']);
	}
}
