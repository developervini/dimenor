<?php
use \Slim\Slim as Slim;

function listUser()
{
	$app = Slim::getInstance();
	$app->render('user/list.html', array('users' => UserController::listUser(), 'user_logged' => $_SESSION['user_logged']));
}

function viewUser($id = int)
{
	$app = Slim::getInstance();
	$app->render('user/view.html', array('user' => UserController::findUser($id), 'user_logged' => $_SESSION['user_logged']));
}

function newUser()
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('user/new.html', array('user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPost()) {
		$response = UserController::newUser($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}	
}

function editUser($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isGet()) {
		$app->render('user/edit.html', array('user' => UserController::findUser($id), 'user_logged' => $_SESSION['user_logged']));
	}elseif ($app->request->isPut()) {
		$response = UserController::editUser($app->request->params());
		$app->render('app/message.html', array('response' => $response, 'user_logged' => $_SESSION['user_logged']));
	}	
}

function activeUser($id = int)
{
	$app = Slim::getInstance();
	if ($app->request->isDelete()) {
		$response = UserController::activeUser($id);
		echo json_encode($response);
	}	
}

function loginUser()
{
	$app = Slim::getInstance();

	if($app->request->isPost()){
		$return = UserController::loginUser($app->request()->params());
		if (!empty($return)) {
			$_SESSION['user_logged'] = $return;
			//$_SESSION['user_logged']->version = App::version();
			$app->redirect('/dashboard');
		}else {
			$app->redirect('/login');
		}
	}else{
		$app->render('user/login.html');
	}
}

function logoutUser()
{
	$app = Slim::getInstance();
	session_destroy();
	$app->redirect('/login');
}

function auth()
{
	$app = Slim::getInstance();
	if(!isset($_SESSION['user_logged']))	
		$app->redirect('/login');
}