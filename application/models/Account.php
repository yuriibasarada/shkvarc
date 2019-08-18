<?php

namespace application\models;

use application\core\Model;

class Account extends Model {

	public function validate($input, $post) {
		$rules = [
            'accounts_email' => [
                'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$#',
                'message' => 'E-mail адрес указан неверно',
            ],
			'regemail' => [
				'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$#',
				'message' => 'E-mail адрес указан неверно',
			],
			'regname' => [
				'pattern' => '#^[a-z0-9]{3,15}$#',
				'message' => 'Логин указан неверно (разрешены только латинские буквы и цифры от 3 до 15 символов',
			],
			'regpass' => [
				'pattern' => '#^[a-z0-9]{10,30}$#',
				'message' => 'Пароль указан неверно (разрешены только латинские буквы и цифры от 10 до 30 символов',
			],
            'logpass' => [
                'pattern' => '#^[a-z0-9]{10,30}$#',
                'message' => 'Пароль указан неверно (разрешены только латинские буквы и цифры от 10 до 30 символов',
            ],
            'logname' => [
                'pattern' => '#^[a-z0-9]{3,15}$#',
                'message' => 'Логин указан неверно (разрешены только латинские буквы и цифры от 3 до 15 символов',
            ],

		];
		foreach ($input as $val) {
			if (!isset($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val])) {
				$this->error = $rules[$val]['message'];
				return false;
			}
		}
		return true;
	}

	public function checkEmailExists($email) {
		$params = [
			'accounts_email' => $email,
		];
		return $this->db->column('SELECT accounts_id FROM accounts WHERE accounts_email = :accounts_email', $params);
	}

	public function checkLoginExists($login) {
		$params = [
			'login' => $login,
		];
		if ($this->db->column('SELECT accounts_id FROM accounts WHERE accounts_login = :login', $params)) {
			$this->error = 'Этот логин уже используется';
			return false;
		}
		return true;
	}

	public function checkTokenExists($token) {
		$params = [
			'token' => $token,
		];
		return $this->db->column('SELECT accounts_id FROM accounts WHERE accounts_token = :token', $params);
	}

	public function activate($token) {
		$params = [
			'token' => $token,
		];
		$this->db->query('UPDATE accounts SET accounts_status_id = 1, accounts_token = "" WHERE accounts_token = :token', $params);
	}

	public function checkRefExists($login) {
		$params = [
			'login' => $login,
		];
		return $this->db->column('SELECT accounts_id FROM accounts WHERE accounts_login = :login', $params);
	}

	public function createToken() {
		return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', 30)), 0, 30);
	}

	public function register($post) {
		$token = $this->createToken();
		$ref = 0;
		$params = [
			'accounts_id' => '',
			'accounts_email' => $post['regemail'],
			'accounts_login' => $post['regname'],
			'accounts_wallet' => 0,
			'accounts_password' => password_hash($post['regpass'], PASSWORD_BCRYPT),
			'accounts_ref' => $ref,
			'accounts_refBalance' => 0,
			'accounts_token' => $token,
			'accounts_status' => 0,
            'accounts_description' => ''
		];
		$this->db->query('INSERT INTO accounts VALUES (:id, :email, :login, :wallet, :password, :ref, :refBalance, :token, :status)', $params);
        @mail($post['regemail'], 'Register', 'Confirm: '.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/account/confirm/'.$token, 'From: yuriyshkvarc@shkvarc.zzz.com.ua' . "\r\n");
        @mail('shkvarcy@gmail.com', 'Новый пользователь', 'Новый пользователь зарегистрирован!'.$post['regnameZ'], 'From: yuriyshkvarc@shkvarc.zzz.com.ua' . "\r\n");

    }

	public function checkData($login, $password) {
		$params = [
			'login' => $login,
		];
		$hash = $this->db->column('SELECT accounts_password FROM accounts WHERE accounts_login = :login', $params);
		if (!$hash or !password_verify($password, $hash)) {
			return false;
		}
		return true;
	}

	public function checkStatus($type, $data) {
		$params = [
			$type => $data,
		];
		$status = $this->db->column('SELECT accounts_status_id FROM accounts WHERE '.$type.' = :'.$type, $params);
		if ($status != 1) {
			$this->error = 'Аккаунт ожидает подтверждения по E-mail';
			return false;
		}
		return true;
	}

	public function login($login) {
		$params = [
			'login' => $login,
		];
		$data = $this->db->row('SELECT * FROM accounts WHERE accounts_login = :login', $params);
		$_SESSION['account'] = $data[0];
	}

	public function recovery($post) {
		$token = $this->createToken();
		$params = [
			'email' => $post['email'],
			'token' => $token,
		];
		$this->db->query('UPDATE accounts SET accounts_token = :token WHERE accounts_email = :email', $params);
		mail($post['email'], 'Recovery', 'Confirm: '.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/account/reset/'.$token);
	}

	public function reset($token) {
		$new_password = $this->createToken();
		$params = [
			'token' => $token,
			'password' => password_hash($new_password, PASSWORD_BCRYPT),
		];
		$this->db->query('UPDATE accounts SET accounts_status_id = 1, accounts_token = "", accounts_password = :password WHERE accounts_token = :token', $params);
		return $new_password;
	}

	public function save($post, $files) {

	    //Загрузка фото

        $uploaddir = DIR_ROOT . '/public/upload/avatar/';
        $save_dir = '/public/upload/avatar/' . basename($files['image']['name']);
        $uploadfile = $uploaddir . basename($files['image']['name']);
        move_uploaded_file($files['image']['tmp_name'], $uploadfile);
		$params = [
			'accounts_id' => $_SESSION['account']['accounts_id'],
			'accounts_email' => $post['accounts_email'],
            'accounts_image' => $save_dir,
            'accounts_description' => $post['accounts_description']
 		];
		if (!empty($post['accounts_password'])) {
			$params['accounts_password'] = password_hash($post['accounts_password'], PASSWORD_BCRYPT);
			$sql = ',accounts_password = :accounts_password';
		}
		else {
			$sql = '';
		}
		foreach ($params as $key => $val) {
			$_SESSION['account'][$key] = $val;
		}
		$this->db->query('UPDATE accounts SET accounts_email = :accounts_email, accounts_image = :accounts_image, 
                                    accounts_description = :accounts_description' .$sql.' 
                              WHERE accounts_id = :accounts_id', $params);
	}

    public function getUser($id)
    {
        $params = ['id' => $id];
        return $this->db->row('SELECT * FROM accounts WHERE accounts_id  = :id', $params);
    }
}