<?php

namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller {

	// Регистрация

	public function registerAction() {
		if (!empty($_POST)) {
			if (!$this->model->validate(['regemail', 'regname', 'regpass'], $_POST)) {
				$this->view->message('error', $this->model->error);
			}
			elseif ($this->model->checkEmailExists($_POST['regemail'])) {
				$this->view->message('error', 'Этот E-mail уже используется');
			}
			elseif (!$this->model->checkLoginExists($_POST['regname'])) {
				$this->view->message('error', $this->model->error);
			}

			$this->model->register($_POST);
			$this->view->message('success', 'Регистрация завершена, подтвердите свой E-mail');
		}
		$var['class'] = 'reg_log';
		$this->view->render('Вход/Регистрация', $var);
	}

	public function confirmAction() {
		if (!$this->model->checkTokenExists($this->route['token'])) {
			$this->view->redirect('account/login');
		}
		$this->model->activate($this->route['token']);
		$this->view->render('Аккаунт активирован');
	}

	// Вход

	public function loginAction() {
		if (!empty($_POST)) {
			if (!$this->model->validate(['logname', 'logpass'], $_POST)) {
				$this->view->message('error', $this->model->error);
			}
			elseif (!$this->model->checkData($_POST['logname'], $_POST['logpass'])) {
				$this->view->message('error', 'Логин или пароль указан неверно');
			}
			elseif (!$this->model->checkStatus('login', $_POST['logname'])) {
				$this->view->message('error', $this->model->error);
			}
			$this->model->login($_POST['logname']);
			$this->view->location('account/profile');
		}
		$this->view->render('Вход');
	}

	// Профиль

	public function profileAction() {
		if (!empty($_POST)) {
			if (!$this->model->validate(['email'], $_POST)) {
				$this->view->message('error', $this->model->error);
			}
			$id = $this->model->checkEmailExists($_POST['email']);
			if ($id and $id != $_SESSION['account']['id']) {
				$this->view->message('error', 'Этот E-mail уже используется');
			}
			if (!empty($_POST['password']) and !$this->model->validate(['password'], $_POST)) {
				$this->view->message('error', $this->model->error);
			}


			$this->model->save($_POST, $_FILES);
			$this->view->message('error', 'Сохранено');
		}
        $var['class'] = 'profile';
        $this->view->render('Профиль', $var);
	}

	public function logoutAction() {
		unset($_SESSION['account']);
		$this->view->redirect('account/register');
	}

	// Восстановление пароля

	public function recoveryAction() {
		if (!empty($_POST)) {
			if (!$this->model->validate(['email'], $_POST)) {
				$this->view->message('error', $this->model->error);
			}
			elseif (!$this->model->checkEmailExists($_POST['email'])) {
				$this->view->message('error', 'Пользователь не найден');
			}
			elseif (!$this->model->checkStatus('email', $_POST['email'])) {
				$this->view->message('error', $this->model->error);
			}
			$this->model->recovery($_POST);
			$this->view->message('success', 'Запрос на восстановление пароля отправлен на E-mail');
		}
		$this->view->render('Восстановление пароля');
	}

	public function resetAction() {
		if (!$this->model->checkTokenExists($this->route['token'])) {
			$this->view->redirect('account/login');
		}
		$password = $this->model->reset($this->route['token']);
		$vars = [
			'password' => $password,
		];
		$this->view->render('Пароль сброшен', $vars);
	}
}